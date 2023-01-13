@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Change Name</h2>
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div> 
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('name.update')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Enter New Name</label>
                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update name</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="card">
            @if (session('success_pass'))
                    <div class="alert alert-success">{{session('success_pass')}}</div> 
            @endif
            @if (session('wrong_password'))
                    <div class="alert alert-danger">{{session('wrong_password')}}</div> 
            @endif
            <div class="card-header">
                <h2>Change Password</h2>
            </div>
            <div class="card-body">
                <form action="{{route('password.update')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Old password</label>
                        <input type="password" name="old_password" placeholder="Old Password" class="form-control">
                        @error('old_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New password</label>
                        <input type="password" name="password" placeholder="New Password" class="form-control">
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
                        @error('password_confirmation')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Profile Picture Change</h2>
            </div>
            <div class="card-body">
                <form action="{{route('image.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        {{-- <input type="file" name="image" class="form-control"> --}}
                        <input type="file" name="image">
                        @error('image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection