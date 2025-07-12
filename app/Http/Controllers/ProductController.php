<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:1000'],
            'logo_path' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request->file('logo_path')->store('product-logos', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'min:3', 'max:1000'],
            'logo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('logo_path')) {
            if ($product->logo_path && Storage::disk('public')->exists($product->logo_path)) {
                Storage::disk('public')->delete($product->logo_path);
            }

            $validated['logo_path'] = $request->file('logo_path')->store('product-logos', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if ($product->logo_path && Storage::disk('public')->exists($product->logo_path)) {
            Storage::disk('public')->delete($product->logo_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus.');
    }
}
