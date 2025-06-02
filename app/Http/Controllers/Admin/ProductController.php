<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->join('brands', 'products.id_brand', '=', 'brands.id_brand')
            ->join('categories', 'products.id_category', '=', 'categories.id_category')
            ->select('products.*', 'brands.brand_name', 'categories.category_name')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = DB::table('brands')->pluck('brand_name', 'id_brand');
        $categories = DB::table('categories')->pluck('category_name', 'id_category');

        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:200',
            'id_brand' => 'required|exists:brands,id_brand',
            'id_category' => 'required|exists:categories,id_category',
            'description' => 'nullable|string',
            'rental_price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'product_name' => $request->product_name,
            'id_brand' => $request->id_brand,
            'id_category' => $request->id_category,
            'description' => $request->description,
            'rental_price' => $request->rental_price,
            'stock' => $request->stock,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/products'), $fileName);
            $data['image'] = $fileName;
        }

        DB::table('products')->insert($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id_product', $id)->first();
        $brands = DB::table('brands')->pluck('brand_name', 'id_brand');
        $categories = DB::table('categories')->pluck('category_name', 'id_category');

        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:200',
            'id_brand' => 'required|exists:brands,id_brand',
            'id_category' => 'required|exists:categories,id_category',
            'description' => 'nullable|string',
            'rental_price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'product_name' => $request->product_name,
            'id_brand' => $request->id_brand,
            'id_category' => $request->id_category,
            'description' => $request->description,
            'rental_price' => $request->rental_price,
            'stock' => $request->stock,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $existingProduct = DB::table('products')->where('id_product', $id)->first();
            if ($existingProduct->image && file_exists(public_path('uploads/products/' . $existingProduct->image))) {
                unlink(public_path('uploads/products/' . $existingProduct->image));
            }

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/products'), $fileName);
            $data['image'] = $fileName;
        }

        DB::table('products')->where('id_product', $id)->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->where('id_product', $id)->first();

        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        DB::table('products')->where('id_product', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
