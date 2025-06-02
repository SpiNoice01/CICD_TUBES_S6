<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:100',
            'category_description' => 'nullable|string',
        ]);

        DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = DB::table('categories')->where('id_category', $id)->first();
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|max:100',
            'category_description' => 'nullable|string',
        ]);

        DB::table('categories')->where('id_category', $id)->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('categories')->where('id_category', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
