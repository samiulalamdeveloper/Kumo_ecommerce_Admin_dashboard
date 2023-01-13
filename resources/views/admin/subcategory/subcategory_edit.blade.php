@extends('layouts.dashboard')
@section('content')
<div class="col-lg-8 col-md-8 m-auto">
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="card-header">
            <h2>Update Category</h2>
        </div>
        <div class="card-body">
            <form action="{{route('update.subcategory')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <select name="category_id" class="form-control" id="">
                            <option value="{{$subcategory_info->category_id}}">{{$subcategory_info->rel_to_category->category_name}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Subcategory name</label>
                    <input type="text" name="subcategory_name" placeholder="Enter subcategory name" value="{{$subcategory_info->subcategory_name}}" class="form-control">
                    <input type="hidden" name="subcategory_id" placeholder="Enter subcategory name" value="{{$subcategory_info->id}}" class="form-control">
                    @error('subcategory_name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Enter Subcategory Image</label>
                    <input type="file" name="subcategory_image" class="form-control" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                    <img src="{{asset('uploads/subcategory')}}/{{$subcategory_info->subcategory_image}}" alt="" id="image" width="100">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Update subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection