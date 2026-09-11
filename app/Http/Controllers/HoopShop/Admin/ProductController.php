<?php

namespace App\Http\Controllers\HoopShop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List all products
    public function index(Request $request)
    {
        $query = $request->input('search');

        $products = Product::query()
            ->when($query, function ($q, $search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('hoop.admin.products.index', compact('products', 'query'));
    }

    // Show add form
    public function create()
    {
        return view('hoop.admin.products.form');
    }

    // Store new product
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $photo = $this->resolvePhoto($request);

        Product::create($data + ['photo' => $photo]);

        return redirect()->route('hoop.admin.products')->with('success', 'Product added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('hoop.admin.products.form', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $this->validateData($request);
        $photo = $this->resolvePhoto($request, $product->photo);

        $product->update($data + ['photo' => $photo]);

        return redirect()->route('hoop.admin.products')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('hoop.admin.products')->with('success', 'Product deleted successfully!');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * Resolve the product photo.
     *
     * An uploaded file wins, otherwise a pasted image URL (e.g. a Google
     * Images link) is used. When neither is provided the current photo is
     * kept (so editing a product without touching the image does not lose it).
     */
    private function resolvePhoto(Request $request, ?string $current = null): ?string
    {
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            ]);

            return $this->uploadPhoto($request);
        }

        if ($request->filled('image_url')) {
            $request->validate([
                'image_url' => ['url', 'max:2048'],
            ]);

            return trim((string) $request->input('image_url'));
        }

        return $current;
    }

    private function uploadPhoto(Request $request): string
    {
        $file = $request->file('photo');
        $dir = public_path('_uploads');

        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $filename = 'product_' . time() . '_' . Str::random(10) . '.' . ($file->guessExtension() ?: 'png');
        $file->move($dir, $filename);

        return $filename;
    }
}
