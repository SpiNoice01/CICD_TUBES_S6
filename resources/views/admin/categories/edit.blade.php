@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Edit Kategori</h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Kategori</li>
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
                            <h4 class="card-title">Edit Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.update',$category->id_category) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" id="category_name" value="{{$category->category_name}}" name="category_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category_description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="category_description" name="category_description">{{$category->category_description}}</textarea>
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
