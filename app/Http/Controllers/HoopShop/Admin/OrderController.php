<?php

namespace App\Http\Controllers\HoopShop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public const STATUSES = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

    // List all orders
    public function index()
    {
        $orders = Order::with('user', 'items')
            ->orderByDesc('created_at')
            ->get();

        $statuses = self::STATUSES;

        return view('hoop.admin.orders.index', compact('orders', 'statuses'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', self::STATUSES)],
        ]);

        $order->update(['status' => $data['status']]);

        return redirect()->route('hoop.admin.orders')->with('success', 'Order #' . $order->id . ' status updated to ' . $data['status'] . '.');
    }

    // Delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('hoop.admin.orders')->with('success', 'Order #' . $id . ' deleted successfully!');
    }
}
