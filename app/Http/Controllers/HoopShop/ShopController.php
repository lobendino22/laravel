<?php

namespace App\Http\Controllers\HoopShop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    // Shop homepage - browse/search products
    public function index(Request $request)
    {
        $query = trim($request->input('search', ''));

        $products = Product::query()
            ->when($query !== '', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->paginate(12);

        return view('hoop.shop', compact('products', 'query'));
    }

    // ---------- Cart (session based) ----------

    // Show cart
    public function cart()
    {
        $items = $this->cartItems();

        return view('hoop.cart', compact('items'));
    }

    // Add a product to the cart
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $qty = max(1, (int) $request->input('qty', 1));

        if ($product->stock < 1) {
            return back()->with('error', 'Sorry, this item is out of stock.');
        }

        $cart = session()->get('cart', []);
        $cart[$productId] = min(($cart[$productId] ?? 0) + $qty, $product->stock);
        session()->put('cart', $cart);

        return back()->with('success', '"' . $product->name . '" added to cart.');
    }

    // Update cart quantities
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('qty', []) as $productId => $qty) {
            $product = Product::find($productId);
            if (! $product) {
                unset($cart[$productId]);
                continue;
            }
            $qty = (int) $qty;
            if ($qty <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = min($qty, $product->stock);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('hoop.cart')->with('success', 'Cart updated.');
    }

    // Remove a product from cart
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return redirect()->route('hoop.cart')->with('success', 'Item removed from cart.');
    }

    // ---------- Checkout ----------

    // Start checkout with the items selected on the cart page (client only)
    public function startCheckout(Request $request)
    {
        $selected = array_map('intval', (array) $request->input('selected', []));

        if (empty($selected)) {
            return redirect()->route('hoop.cart')->with('error', 'Select at least one item to check out.');
        }

        // Apply any quantity changes submitted with the form
        $cart = session()->get('cart', []);
        foreach ($request->input('qty', []) as $productId => $qty) {
            $product = Product::find($productId);
            if (! $product) {
                unset($cart[$productId]);
                continue;
            }
            $qty = (int) $qty;
            if ($qty <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = min($qty, $product->stock);
            }
        }
        session()->put('cart', $cart);

        // Stage only the selected items for checkout
        $items = collect($this->cartItems())
            ->filter(fn ($item) => in_array($item['product']->id, $selected))
            ->values()
            ->all();

        if (empty($items)) {
            return redirect()->route('hoop.cart')->with('error', 'Select at least one item to check out.');
        }

        session()->put('checkout_items', $items);

        return redirect()->route('hoop.checkout');
    }

    // Show checkout form (client only)
    public function showCheckout()
    {
        $items = session('checkout_items', []);

        if (empty($items)) {
            $items = $this->cartItems();
        }

        if (empty($items)) {
            return redirect()->route('hoop.cart')->with('error', 'Your cart is empty.');
        }

        return view('hoop.checkout', compact('items'));
    }

    // Place the order
    public function placeOrder(Request $request)
    {
        $items = session('checkout_items', []);

        if (empty($items)) {
            $items = $this->cartItems();
        }

        if (empty($items)) {
            return redirect()->route('hoop.cart')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        // Check stock once more before saving
        foreach ($items as $item) {
            if ($item['product']->stock < $item['qty']) {
                return back()->with('error', '"' . $item['product']->name . '" no longer has enough stock.');
            }
        }

        $total = collect($items)->sum(fn ($i) => $i['subtotal']);

        $order = DB::transaction(function () use ($items, $data, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'Pending',
                'phone' => $data['phone'],
                'address' => $data['address'],
                'note' => $data['note'] ?? null,
            ]);

            foreach ($items as $item) {
                $product = $item['product'];
                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['qty'],
                ]);
                $product->decrement('stock', $item['qty']);
            }

            return $order;
        });

        // Remove only the ordered items, keeping unchecked items in the cart
        $orderedIds = collect($items)->pluck('product.id')->all();
        $cart = session()->get('cart', []);
        foreach ($orderedIds as $id) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        session()->forget('checkout_items');

        return redirect()->route('hoop.orders')
            ->with('success', 'Order #' . $order->id . ' placed successfully!');
    }

    // ---------- Client dashboard (client only) ----------

    public function dashboard()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'Pending')->count();
        $deliveredOrders = $orders->where('status', 'Delivered')->count();
        $totalSpent = $orders->where('status', '!=', 'Cancelled')->sum('total');
        $recentOrders = $orders->take(5);

        return view('hoop.dashboard', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'totalSpent',
            'recentOrders'
        ));
    }

    // ---------- My orders (client only) ----------

    public function myOrders()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('hoop.my-orders', compact('orders'));
    }

    // ---------- Helpers ----------

    // Build cart items from the session cart
    private function cartItems(): array
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return [];
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $items = [];

        foreach ($cart as $productId => $qty) {
            $product = $products->get($productId);
            if (! $product) {
                continue;
            }
            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'subtotal' => $product->price * $qty,
            ];
        }

        return $items;
    }
}
