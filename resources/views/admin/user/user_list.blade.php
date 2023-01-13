@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>List of users</h3>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">image</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Updated_at</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $sl=>$user)
                        
                  <tr>
                    <th>{{$sl+1}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                    @if ($user->image == null)
                        <img width="50" src="{{Avatar::create($user->name)->toBase64()}}" alt="">
                    @else
                        <img width="50" src="{{asset('uploads/users')}}/{{$user->image}}" alt="">
                    @endif
                    </td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at}}</td>
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
                                <a class="dropdown-item" href="{{route('user.delete', $user->id)}}">Delete</a>
                            </div>
                        </div>
                    </td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
        </div>
    </div>
@endsection