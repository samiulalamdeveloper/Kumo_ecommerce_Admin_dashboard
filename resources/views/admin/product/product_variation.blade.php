@extends('layouts.dashboard')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">App</a></li>
        <li class="breadcrumb-item active"><a href="#">Product Variation</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-8 col-md-8">
        <div class="card">
            @if (session('successcolor'))
                <div class="alert alert-success">{{session('successcolor')}}</div>
            @endif
            <div class="card-header">
                <h2>Product List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Color name</th>
                        <th>Color</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $sl=>$color)
                            
                      <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$color->color_name}}</td>
                        <td><div style="background-color: {{$color->color_code}}; width: 40px;  height: 40px;" class="d-flex align-items-center justify-content-center">
                        {{($color->color_code == null) ? 'N/A' : ''}}
                        </div></td>
                        <td>
                            <a href="{{route('color.delete', $color->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
    
                      @endforeach
    
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header">
                <h2>Add Color</h2>
            </div>
            <div class="card-body">
                <form action="{{route('add.color')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" name="color_name" placeholder="Enter color name" class="form-control">
                        @error('color_name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" name="color_code" placeholder="Enter color code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-md-8">
        <div class="card">
            @if (session('successsizee'))
                <div class="alert alert-success">{{session('successsizee')}}</div>
            @endif
            <div class="card-header">
                <h2>Size List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Size</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $sl=>$size)
                            
                      <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$size->size}}</td>
                        <td>
                            <a href="{{route('size.delete', $size->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
    
                      @endforeach
    
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card">
            @if (session('successsize'))
                <div class="alert alert-success">{{session('successsize')}}</div>
            @endif
            <div class="card-header">
                <h2>Add Size</h2>
            </div>
            <div class="card-body">
                <form action="{{route('add.size')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Size</label>
                        <input type="text" name="size" placeholder="Enter Size" class="form-control">
                        @error('size')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection