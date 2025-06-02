@extends('layouts.admin')
@section('title', 'Tambah Paket')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Tambah Paket</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Paket</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">



                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Paket</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="package_name">Package Name</label>
                                    <input type="text" name="package_name" id="package_name" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="package_description">Description</label>
                                    <textarea name="package_description" id="summernote" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="package_price">Price</label>
                                    <input type="number" step="0.01" name="package_price" id="package_price"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Products</label>
                                    <div>
                                        @foreach ($products as $product)
                                            <div class="form-check mt-2">
                                                <input type="number" class="form-control d-inline-block w-auto"
                                                    name="products[{{ $product->id_product }}]"
                                                    placeholder="{{ $product->product_name }}" min="0">
                                                <label class="form-check-label ml-2">{{ $product->product_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
@endsection
@section('js')

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

@endsection
