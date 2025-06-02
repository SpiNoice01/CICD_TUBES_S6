@extends('layouts.admin')
@section('title', 'Edit Brand')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Edit Brand</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Brand</li>
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
                            <h4 class="card-title">Edit Brand</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('brands.update', $brand->id_brand) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" value="{{$brand->brand_name}}" id="brand_name" name="brand_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="brand_logo" class="form-label">Brand Logo</label>
                                    <input type="file" class="form-control" id="brand_logo" name="brand_logo">
                                </div>
                                <div class="mb-3">
                                    <label for="brand_description" class="form-label">Brand Description</label>
                                    <textarea class="form-control" id="brand_description" name="brand_description">{{$brand->brand_description}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
@endsection
