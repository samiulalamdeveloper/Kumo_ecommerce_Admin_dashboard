@extends('layouts.dashboard')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">App</a></li>
        <li class="breadcrumb-item active"><a href="#">Inventory</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-8 col-md-8">
        <div class="card">
            @if (session('inventorydel'))
                <div class="alert alert-success">{{session('inventorydel')}}</div>
            @endif
            <div class="card-header">
                <h2>Inventory List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $sl=>$inventory)
                            
                      <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$inventory->rel_to_color->color_name}}</td>
                        <td>{{$inventory->rel_to_size->size}}</td>
                        <td>{{$inventory->quantity}}</td>
                        <td>
                            <a href="{{route('inventory.delete', $inventory->id)}}" class="btn btn-danger">Delete</a>
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
                <h2>Add Inventory</h2>
            </div>
            <div class="card-body">
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="product_id" value="{{$product_info->id}}">
                        <input type="text" readonly class="form-control" value="{{$product_info->product_name}}"> 
                    </div>
                    <div class="mb-3">
                        <select name="color_id" class="form-control" id="">
                            <option value="">-- Select Color --</option>
                            @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="size_id">
                            <option value="">-- Select Size --</option>
                            @foreach ($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                        @error('size_id')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Quantity</label>
                        <input type="number" name="quantity" placeholder="enter quantity" class="form-control">
                        @error('quantity')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection