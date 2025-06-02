@extends('layouts.admin')
@section('title', 'Produk')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Produk</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
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
                            <h4 class="card-title">List Brand</h4>
                            <div class="card-tools float-right mb-2">
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center text-nowrap" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Brand</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($product->image)
                                                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                                                            alt="{{ $product->product_name }}" width="50">
                                                    @else
                                                        No Logo
                                                    @endif
                                                </td>

                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category_name }}</td>
                                                <td>{{ $product->brand_name }}</td>
                                                <td>Rp{{ number_format($product->rental_price) }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>

                                                    <a href="{{ route('products.edit', $product->id_product) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('products.destroy', $product->id_product) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
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
