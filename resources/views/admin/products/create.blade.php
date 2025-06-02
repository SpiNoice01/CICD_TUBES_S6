@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Tambah Produk</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
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
                            <h4 class="card-title">Tambah Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                        id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Brand -->
                                <div class="mb-3">
                                    <label for="id_brand" class="form-label">Brand</label>
                                    <select class="form-control @error('id_brand') is-invalid @enderror" id="id_brand"
                                        name="id_brand" required>
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $id => $brand_name)
                                            <option value="{{ $id }}"
                                                {{ old('id_brand') == $id ? 'selected' : '' }}>{{ $brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="id_category" class="form-label">Category</label>
                                    <select class="form-control @error('id_category') is-invalid @enderror" id="id_category"
                                        name="id_category" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $id => $category_name)
                                            <option value="{{ $id }}"
                                                {{ old('id_category') == $id ? 'selected' : '' }}>{{ $category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Rental Price -->
                                <div class="mb-3">
                                    <label for="rental_price" class="form-label">Rental Price</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('rental_price') is-invalid @enderror" id="rental_price"
                                        name="rental_price" value="{{ old('rental_price') }}" required>
                                    @error('rental_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Stock -->
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" value="{{ old('stock') }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Create Product</button>
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

