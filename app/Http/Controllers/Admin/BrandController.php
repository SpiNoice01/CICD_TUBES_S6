<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:100',
            'brand_logo' => 'nullable|image|max:2048',
            'brand_description' => 'nullable|string',
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;

        if ($request->hasFile('brand_logo')) {
            $fileName = time() . '.' . $request->brand_logo->getClientOriginalExtension();
            $request->brand_logo->move(public_path('uploads/brands'), $fileName);
            $brand->brand_logo = $fileName;
        }

        $brand->brand_description = $request->brand_description;
        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit($id)
    {
        $brand = DB::table('brands')->where('id_brand', $id)->first();
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|max:100',
            'brand_logo' => 'nullable|image|max:2048',
            'brand_description' => 'nullable|string',
        ]);

        $data = [
            'brand_name' => $request->brand_name,
            'brand_description' => $request->brand_description,
            'updated_at' => now(),
        ];

        if ($request->hasFile('brand_logo')) {
            $existingBrand = DB::table('brands')->where('id_brand', $id)->first();
            if ($existingBrand->brand_logo && file_exists(public_path('uploads/brands/' . $existingBrand->brand_logo))) {
                unlink(public_path('uploads/brands/' . $existingBrand->brand_logo));
            }

            $fileName = time() . '.' . $request->brand_logo->getClientOriginalExtension();
            $request->brand_logo->move(public_path('uploads/brands'), $fileName);
            $data['brand_logo'] = $fileName;
        }

        DB::table('brands')->where('id_brand', $id)->update($data);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = DB::table('brands')->where('id_brand', $id)->first();

        if ($brand->brand_logo && file_exists(public_path('uploads/brands/' . $brand->brand_logo))) {
            unlink(public_path('uploads/brands/' . $brand->brand_logo));
        }

        DB::table('brands')->where('id_brand', $id)->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
