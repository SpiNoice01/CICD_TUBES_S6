@extends('layouts.admin')
@section('title', 'Penyewa')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Penyewa</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penyewa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">



                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Penyewa</h4>
                       
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center text-nowrap" id="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Penyewa</th>
                                            <th>Nomor Telepon</th>
                                            <th>Bukti Bayar</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Lama Sewa (Hari)</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($renters as $renter)
                                            <tr>
                                                <td>{{ $renter->first_name }} {{ $renter->last_name }}</td>
                                                <td>{{ $renter->phone_number }}</td>
                                                <td>
                                                  <img src="{{asset($renter->payment_proof)}}" width="50" alt="">
                                                </td>
                                                <td class="border px-4 py-2">{{ $renter->address }}</td>
                                                <td class="border px-4 py-2">{{ $renter->rental_date }}</td>
                                                <td class="border px-4 py-2">{{ $renter->return_date }}</td>
                                                <td class="border px-4 py-2">{{ $renter->rental_days }}</td>
                                                <td>
                                                    Rp{{number_format($renter->total_price)}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
@endsection
