@extends('layouts.admin')
@section('title', 'Brand')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Brand</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Brand</li>
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
                                <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center text-nowrap" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Logo</th>
                                            <th>Nama</th>
                                            <th>Desc</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($brand->brand_logo)
                                                        <img src="{{ asset('uploads/brands/' . $brand->brand_logo) }}"
                                                            alt="{{ $brand->brand_name }}" width="50">
                                                    @else
                                                        No Logo
                                                    @endif
                                                </td>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td>{{ $brand->brand_description }}</td>
                                                <td>
                                                   
                                                    <a href="{{ route('brands.edit', $brand->id_brand) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('brands.destroy', $brand->id_brand) }}"
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
