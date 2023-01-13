@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">App</a></li>
        <li class="breadcrumb-item active"><a href="#">Add Product</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
                
            @endif
            <div class="card-header">
                <h2>Add Product</h2>
            </div>
            <div class="card-body">
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6 col-xl-6">
                            <select name="category_id" class="form-control category_id" id="">
                                <option value="">-- Select Category --</option>
                                @foreach ($category_info as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6 col-xl-6">
                            <select name="subcategory_id" class="form-control subcategory_id" id="subcategory">
                                <option value="">-- Select Subcategory --</option>
                            </select>
                            @error('subcategory_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-xl-6 col-md-6">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="product name">
                            @error('product_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3 col-xl-6 col-md-6">
                            <label for="" class="form-label">Product Price</label>
                            <input type="text" name="product_price" class="form-control" placeholder="product price">
                            @error('product_price')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-xl-6 col-md-6">
                            <label for="" class="form-label">Product Discount</label>
                            <input type="text" name="product_discount" class="form-control" placeholder="product discount %">
                            @error('product_discount')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3 col-xl-6 col-md-6">
                            <label for="" class="form-label">Product Brand</label>
                            <input type="text" name="product_brand" class="form-control" placeholder="product brand">
                            @error('product_brand')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-xl-12 col-md-12">
                        <label for="" class="form-label">Short Description</label>
                        <input type="text" name="short_desp" class="form-control" placeholder="short description">
                        @error('short_desp')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-xl-12 col-md-12">
                        <label for="" class="form-label">Description</label>
                        <textarea name="long_desp" class="form-control" id="summernote" placeholder="Description" style="resize: none"></textarea>
                        @error('long_desp')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col-xl-6 col-md-6">
                            <label for="" class="form-label">Product Preview</label>
                            <input type="file" name="preview" class="form-control" placeholder="product preview">
                            @error('preview')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3 col-xl-6 col-md-6">
                            <label for="" class="form-label">Product Thumbnail</label>
                            <input type="file" name="thumbnail[]" multiple class="form-control" placeholder="product thumbnail">
                            @error('thumbnail')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $('.category_id').change(function() {
        var category_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/getSubcategory',
            data: {'categoryid': category_id},
            success: function(data) {
                $('#subcategory').html(data);
            }
        })
    })
</script> 
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>   
@endsection