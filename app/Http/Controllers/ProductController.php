<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        return Product::where('product_name', 'LIKE', "%{$query}%")
            ->orWhere('product_description', 'LIKE', "%{$query}%")
            ->select('id', 'product_name', 'slug', 'selling_price', 'product_image')
            ->limit(5)
            ->get();
    }

    public function getCategoryProducts($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            $products = Product::where('category_id', $category->id)
                ->select('id', 'product_name', 'slug', 'selling_price', 'product_image')
                ->paginate(12);

            return response()->json([
                'success' => true,
                'category' => $category,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }

    public function create()
    {
        $brands = Brand::all();
        return view('backoffice.product.add_product', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            // ... your existing validation rules ...
        ]);

        try {
            $product = new Product();
            $product->brand_id = $request->brand_id;
            // ... your existing product creation code ...

            return redirect()->route('products.index')
                           ->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add product: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        return view('backoffice.product.edit_product', compact('product', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            // ... your existing validation rules ...
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->brand_id = $request->brand_id;
            // ... your existing update code ...

            return redirect()->route('products.index')
                           ->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }
} 