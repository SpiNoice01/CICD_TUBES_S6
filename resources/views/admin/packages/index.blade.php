@extends('layouts.admin')
@section('title', 'Paket')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Paket</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Paket</li>
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
                            <h4 class="card-title">List Paket</h4>
                            <div class="card-tools float-right mb-2">
                                <a href="{{ route('packages.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center text-nowrap" id="table">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packages as $package)
                                            <tr>
                                                
                                                <td>
                                                    @if ($package->image)
                                                        <img src="{{ asset($package->image) }}"
                                                            alt="{{ $package->package_name }}" width="50">
                                                    @else
                                                        No Logo
                                                    @endif
                                                </td>
                                             
                                                <td>{{ $package->package_name }}</td>
                                                <td>{{ number_format($package->package_price, 2) }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($package->details as $detail)
                                                            <li>{{ $detail->product_name }} ({{ $detail->quantity }})</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="{{ route('packages.edit', $package->id_package) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('packages.destroy', $package->id_package) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Delete</button>
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
