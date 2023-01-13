@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('home')}}">App</a></li>
        <li class="breadcrumb-item active"><a href="{{url('subcategory')}}">Subcategory</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 m-auto">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header">
                <h2>Add SubCategory</h2>
            </div>
            <div class="card-body">
                <form action="{{route('add.subcategory')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" class="form-control" id="">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subcategory name</label>
                        <input type="text" name="subcategory_name" placeholder="Enter subcategory name" class="form-control">
                        @error('subcategory_name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Enter Subcategory Image</label>
                        <input type="file" name="subcategory_image" class="form-control" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        <img src="" alt="" id="image" width="100">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Subcategory List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped display" id="table_id">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category name</th>
                        <th scope="col">SubCategory name</th> 
                        <th scope="col">SubCategory image</th>
                        <th scope="col">Added by</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $sl=>$subcategory)
                            
                      <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$subcategory->rel_to_category->category_name}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td><img width="80" src="{{asset('uploads/subcategory')}}/{{$subcategory->subcategory_image}}" alt=""></td>
                        <td>{{$subcategory->rel_to_user->name}}</td>
                        <td>{{$subcategory->created_at->diffForHumans()}}</td>
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
                                    <a class="dropdown-item" href="{{route('subcategory.edit', $subcategory->id)}}">edit</a>
                                    <a class="dropdown-item" href="{{route('subcategory.delete', $subcategory->id)}}">Delete</a>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Trashed Subcategory List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped display" id="table_id">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category name</th>
                        <th scope="col">SubCategory name</th> 
                        <th scope="col">SubCategory image</th>
                        <th scope="col">Added by</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashed_subcategories as $sl=>$subcategory)
                            
                      <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$subcategory->rel_to_category->category_name}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td><img width="80" src="{{asset('uploads/subcategory')}}/{{$subcategory->subcategory_image}}" alt=""></td>
                        <td>{{$subcategory->rel_to_user->name}}</td>
                        <td>{{$subcategory->created_at->diffForHumans()}}</td>
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
                                    <a class="dropdown-item" href="{{route('subcategory.restore', $subcategory->id)}}">Restore</a>
                                    <a class="dropdown-item" href="{{route('subcategory.force.delete', $subcategory->id)}}">Delete</a>
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
@section('footer_script')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endsection