@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">App</a></li>
        <li class="breadcrumb-item active"><a href="#">Category edit</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-8 col-lg-8 m-auto">
        <div class="card">
            @if (session('updatesuccess'))
                <div class="alert alert-success">{{session('updatesuccess')}}</div>
            @endif
            <div class="card-header">
                <h2>Category Edit</h2>
            </div>
            <div class="card-body">
                <form action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="category_name" value="{{$category_info->category_name}}" class="form-control">
                        <input type="hidden" name="category_id" value="{{$category_info->id}}" class="form-control">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" name="category_image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        @error('category_image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <img src="{{asset('uploads/category')}}/{{$category_info->category_image}}" alt="" id="image" width="200">
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection