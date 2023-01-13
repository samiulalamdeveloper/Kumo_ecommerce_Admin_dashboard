@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">App</a></li>
        <li class="breadcrumb-item active"><a href="#">Product List</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @if (session('productdelete'))
                <div class="alert alert-success">{{session('productdelete')}}</div>
            @endif
            <div class="card-header">
                <h2>Product List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After_discount</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_info as $sl=>$product)
                            
                      <tr>
                        <th>{{$sl+1}}</th>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{($product->product_discount == null) ? 'N/A' : $product->product_discount}}</td>
                        <td>{{$product->after_discount}}</td>
                        <td>{{$product->product_brand}}</td>
                        <td>{{$product->rel_to_category->category_name}}</td>
                        <td>{{$product->rel_to_subcategory->subcategory_name}}</td>
                        <td><img width="80" src="{{asset('uploads/products/preview')}}/{{$product->preview}}" alt=""></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24">
                                            </rect>
                                            <circle fill="#000000" cx="5" cy="12" r="2">
                                            </circle>
                                            <circle fill="#000000" cx="12" cy="12" r="2">
                                            </circle>
                                            <circle fill="#000000" cx="19" cy="12" r="2">
                                            </circle>
                                        </g>
                                    </svg>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('inventory', $product->id)}}">inventory</a>
                                    <a class="dropdown-item" href="{{route('product.delete', $product->id)}}">delete</a>
                                    {{-- <a class="dropdown-item" href="{{route('category.delete', $category->id)}}">Delete</a> --}}
                                </div>
                            </div>
                        </td>
                      </tr>
    
                      @endforeach
    
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection