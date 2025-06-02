<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentersController extends Controller
{
    public function index()
    {
        $renters = DB::table('rentals')
        ->join('renters', 'rentals.id_renter', '=', 'renters.id_renter')
        ->select(
            'rentals.*',
            'renters.first_name',
            'renters.last_name',
            'renters.phone_number',
            'renters.address',
            DB::raw("DATEDIFF(rentals.return_date, rentals.rental_date) + 1 as rental_days")
        )
        ->get();
         return view('admin.renters.index', compact('renters'));
    }
}
