@extends('layouts.frontend')
@section('title','Profile')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('Profile') }}</h3>
            </div><br><br>
            <div class="card-body">
                <form data-parsley-validate enctype="multipart/form-data"
                    action="{{route('user.profile.change',$user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name*</label>
                        <input maxlength="191" autofocus required type="text" value="{{$user->name}}" name="name"
                            class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label>Email address*</label>
                        <input disabled value="{{$user->email}}" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input value="{{$user->phone}}" name="phone" type="text" class="form-control"
                            placeholder="Enter Phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input maxlength="191" value="{{$user->address}}" name="address" type="text"
                            class="form-control" placeholder="Enter Address">
                    </div>

                    <div class="form-group">
                        <label>Image</label><br>
                        <img src="{{asset('images/'.$user->image)}}" alt="No Image Found"><br>
                        <input name="image" type="file" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-footer pt-4 pt-2 mt-4 border-top">
                        <button type="submit" class="mb-1 btn btn-success">
                            <i class=" mdi mdi-checkbox-marked-outline mr-1"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection