@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('home')}}">App</a></li>
        <li class="breadcrumb-item active"><a href="{{route('category')}}">Category</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Category List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Category image</th>
                        <th scope="col">Added by</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $sl=>$category)
                            
                      <tr>
                        <th>{{$sl+1}}</th>
                        <td>{{$category->category_name}}</td>
                        <td><img width="80" src="{{asset('uploads/category')}}/{{$category->category_image}}" alt=""></td>
                        <td>{{$category->rel_to_user->name}}</td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
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
                                    {{-- <a class="dropdown-item" href="#">Edit</a> --}}
                                    <a class="dropdown-item" href="{{route('category.edit', $category->id)}}">edit</a>
                                    <a class="dropdown-item" href="{{route('category.delete', $category->id)}}">Delete</a>
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
    <div class="col-md-4 col-lg-4">
        @if (session('category_delete'))
            <div class="alert alert-success">{{session('category_delete')}}</div>
        @endif
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header">
                <h2>Add Category</h2>
            </div>
            <div class="card-body">
                <form action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Enter Category Name</label>
                        <input type="text" name="category_name" placeholder="Enter category name" class="form-control">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Enter Category Name</label>
                        <input type="file" name="category_image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        <img src="" alt="" id="image" width="100">
                        @error('category_image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Trashed Category List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Category image</th>
                        <th scope="col">Added by</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashed_categories as $sl=>$category)
                            
                      <tr>
                        <th>{{$sl+1}}</th>
                        <td>{{$category->category_name}}</td>
                        <td><img width="80" src="{{asset('uploads/category')}}/{{$category->category_image}}" alt=""></td>
                        <td>{{$category->rel_to_user->name}}</td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
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
                                    {{-- <a class="dropdown-item" href="#">Edit</a> --}}
                                    {{-- <a class="dropdown-item" href="{{route('category.edit', $category->id)}}">edit</a> --}}
                                    <a class="dropdown-item" href="{{route('category.force.delete', $category->id)}}">Delete</a>
                                    
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