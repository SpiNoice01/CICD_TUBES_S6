<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontConroller extends Controller
{
    

    public function home()
    {
        $packages = DB::table('packages')->get();
        return view('home', compact('packages'));
    }
    
    
    // Menampilkan halaman produk dengan fitur filter berdasarkan merek dan pencarian
    public function product(Request $request)
    {
        $brandId = $request->input('brand');
        $search = $request->input('search');

        $query = DB::table('products')->join('brands', 'products.id_brand', '=', 'brands.id_brand')->select('products.*', 'brands.brand_name');

        if ($brandId) {
            $query->where('products.id_brand', $brandId);
        }

        if ($search) {
            $query->where('products.product_name', 'like', '%' . $search . '%');
        }

        $products = $query->get();

        $brands = DB::table('brands')->get();

        return view('product', compact('products', 'brands'));
    }
    
    // Menampilkan halaman penyelesaian checkout
    public function checkoutFinish()
    {

        $products = DB::table('products')->get();
      
        return view('checkout-finish', compact('products'));
    }

        // Menampilkan halaman detail produk
    public function productDetail($id)
    {
        $product = DB::table('products')->where('id_product', $id)->first();
        $products = DB::table('products')->where('id_product', '!=', $id)->get();
        return view('detail-product', compact('product', 'products'));
    }

    public function about()
    {
        return view('about');
    }

    public function recommended()
    {
        $packages = DB::table('packages')->get();
        return view('recommended', compact('packages'));
    }

    // menampilkan halaman detail recommended
    public function recommendedDetail($id)
    {
        if (!$id) {
            abort(404, 'Package not found.');
        }

        $package = DB::table('packages')->leftJoin('package_details', 'packages.id_package', '=', 'package_details.id_package')->leftJoin('products', 'package_details.id_product', '=', 'products.id_product')->select('packages.id_package', 'packages.package_name', 'packages.package_description', 'packages.package_price', 'packages.image', 'packages.created_at', 'packages.updated_at', DB::raw('GROUP_CONCAT(CONCAT(products.product_name, ":", package_details.quantity)) as details'))->where('packages.id_package', $id)->groupBy('packages.id_package', 'packages.package_name', 'packages.package_description', 'packages.package_price', 'packages.image', 'packages.created_at', 'packages.updated_at')->first();

        if ($package) {
            $package->details = collect(explode(',', $package->details))->map(function ($detail) {
                [$name, $quantity] = explode(':', $detail);
                return (object) [
                    'product_name' => $name,
                    'quantity' => (int) $quantity,
                ];
            });
        }

        $products = DB::table('products')->get();

        return view('detail-recommended', compact('package', 'products'));
    }
    
    // Menampilkan halaman checkou
    public function checkout(Request $request)
    {
        $product = null;
        $package = null;

        if ($request->has('id_product')) {
            $product = DB::table('products')->where('id_product', $request->input('id_product'))->first();
        }

        if ($request->has('id_package')) {
            $package = DB::table('packages')->where('id_package', $request->input('id_package'))->first();
        }

        return view('checkout', compact('product', 'package'));
    }
    
     // Memproses data checkout, menyimpan ke database, dan menghitung total harga
     public function processCheckout(Request $request)
        {
            
            $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name' => 'nullable|string|max:100',
                'address' => 'required|string',
                'phone_number' => 'required|string|max:20',
                'id_card_number' => 'nullable|string|max:50',
                'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'rental_date' => 'required|date',
                'return_date' => 'required|date|after_or_equal:rental_date',
                'product_ids' => 'array',
                'product_ids.*' => 'exists:products,id_product',
                'package_ids' => 'array',
                'package_ids.*' => 'exists:packages,id_package',
            ]);
            
            // Hitung durasi penyewaan
            $rentalDate = new \DateTime($request->input('rental_date'));
            $returnDate = new \DateTime($request->input('return_date'));
            $rentalDays = $rentalDate->diff($returnDate)->days + 1;
            
            // simpan buki pembayaran
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/payment_proofs'), $filename);
                $paymentProofPath = 'uploads/payment_proofs/' . $filename;
            }
            
            
            // Simpan data penyewa
            $renterId = DB::table('renters')->insertGetId([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'address' => $request->input('address'),
                'phone_number' => $request->input('phone_number'),
                'id_card_number' => $request->input('id_card_number'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Simpan data rental
            $rentalId = DB::table('rentals')->insertGetId([
                'id_renter' => $renterId,
                'rental_date' => $request->input('rental_date'),
                'return_date' => $request->input('return_date'),
                'total_price' => 0, 
                'status' => 'pending',
                'payment_proof' => $paymentProofPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            
            // Hitung total harga untuk produk dan paket
            $totalPrice = 0;
    
            if ($request->has('product_ids')) {
                foreach ($request->input('product_ids') as $id_product) {
                    $product = DB::table('products')->where('id_product', $id_product)->first();
                    if ($product) {
                        $priceForDays = $product->rental_price * $rentalDays;
                        DB::table('rental_details')->insert([
                            'id_rental' => $rentalId,
                            'id_product' => $id_product,
                            'id_package' => null,
                            'quantity' => 1,
                            'price_per_item' => $priceForDays,
                        ]);
        
                        $totalPrice += $priceForDays;
                    }
                }
            }
    
            if ($request->has('package_ids')) {
                foreach ($request->input('package_ids') as $id_package) {
                    $package = DB::table('packages')->where('id_package', $id_package)->first();
                    if ($package) {
                        $priceForDays = $package->package_price * $rentalDays;
                        DB::table('rental_details')->insert([
                            'id_rental' => $rentalId,
                            'id_product' => null,
                            'id_package' => $id_package,
                            'quantity' => 1,
                            'price_per_item' => $priceForDays,
                        ]);
        
                        $totalPrice += $priceForDays;
                    }
                }
            }
            
            
            // Update total harga di tabel rental
            DB::table('rentals')
                ->where('id_rental', $rentalId)
                ->update(['total_price' => $totalPrice]);
    
            return redirect()->route('checkout.finish')->with('success', 'Pesanan berhasil diproses.');
        }
}
