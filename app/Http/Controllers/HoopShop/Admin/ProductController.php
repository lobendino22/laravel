<?php

namespace App\Http\Controllers\HoopShop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('hoop.admin.products.index', compact('products'));
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

        $filename = null;
        if ($request->file('photo')) {
            $filename = $this->uploadPhoto($request);
        }

        Product::create($data + ['photo' => $filename]);

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

        $filename = $product->photo;
        if ($request->file('photo')) {
            $filename = $this->uploadPhoto($request);
        }

        $product->update($data + ['photo' => $filename]);

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

    private function uploadPhoto(Request $request): string
    {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('_uploads'), $filename);
        return $filename;
    }
}
