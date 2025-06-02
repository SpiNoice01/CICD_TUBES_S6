<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{   
    
    public function index()
    {   
        // Mengambil data paket dengan join ke package_details dan products
        $packages = DB::table('packages')
            ->leftJoin('package_details', 'packages.id_package', '=', 'package_details.id_package')
            ->leftJoin('products', 'package_details.id_product', '=', 'products.id_product')
            ->select('packages.id_package', 'packages.package_name', 'packages.package_description', 'packages.package_price', 'packages.image', 'packages.created_at', 'packages.updated_at', DB::raw('GROUP_CONCAT(products.product_name, ":", package_details.quantity) as details'))
            ->groupBy('packages.id_package', 'packages.package_name', 'packages.package_description', 'packages.package_price', 'packages.image', 'packages.created_at', 'packages.updated_at')
            ->get()
            ->map(function ($package) {
                $package->details = collect(explode(',', $package->details))->map(function ($detail) {
                    [$name, $quantity] = explode(':', $detail);
                    return (object) ['product_name' => $name, 'quantity' => $quantity];
                });
                return $package;
            });

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $products = DB::table('products')->get();
        return view('admin.packages.create', compact('products'));
    }

    public function edit($id)
    {
        $package = DB::table('packages')->where('id_package', $id)->first();
        $products = DB::table('products')->get();
        $packageDetails = DB::table('package_details')->where('id_package', $id)->get();

        return view('admin.packages.edit', compact('package', 'products', 'packageDetails'));
    }

 public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'package_name' => 'required|string|max:100',
            'package_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Menyiapkan data paket
        $packageData = [
            'package_name' => $request->package_name,
            'package_description' => $request->package_description,
            'package_price' => $request->package_price,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Jika ada gambar yang diunggah, simpan gambar dan tambahkan ke data paket
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/packages'), $imageName);
            $packageData['image'] = 'uploads/packages/' . $imageName;
        }

        // Menyimpan data paket ke tabel packages dan mendapatkan ID-nya
        $idPackage = DB::table('packages')->insertGetId($packageData);

        // Menyimpan detail paket ke tabel package_details jika ada produk yang dipilih
        if ($request->products) {
            foreach ($request->products as $productId => $quantity) {
                if ($quantity > 0) {
                    DB::table('package_details')->insert([
                        'id_package' => $idPackage,
                        'id_product' => $productId,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }

        return redirect()->route('packages.index')->with('success', 'Package created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:100',
            'package_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $packageData = [
            'package_name' => $request->package_name,
            'package_description' => $request->package_description,
            'package_price' => $request->package_price,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $oldImage = DB::table('packages')->where('id_package', $id)->value('image');
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('upload/packages'), $imageName);
            $packageData['image'] = 'upload/packages/' . $imageName;
        }

        DB::table('packages')->where('id_package', $id)->update($packageData);

        DB::table('package_details')->where('id_package', $id)->delete();
        if ($request->products) {
            foreach ($request->products as $productId => $quantity) {
                if ($quantity > 0) {
                    DB::table('package_details')->insert([
                        'id_package' => $id,
                        'id_product' => $productId,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }

        return redirect()->route('packages.index')->with('success', 'Package updated successfully!');
    }

    public function destroy($id)
    {
        $image = DB::table('packages')->where('id_package', $id)->value('image');
        if ($image && file_exists(public_path($image))) {
            unlink(public_path($image));
        }

        DB::table('package_details')->where('id_package', $id)->delete();
        DB::table('packages')->where('id_package', $id)->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully!');
    }
}
