@extends('layouts.frontend')
@section('title','Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Register here
                </div>
                <div class="card-body">
                    <form data-parsley-validate enctype="multipart/form-data" action="{{route('register')}}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name*</label>
                            <input maxlength="191" autofocus required type="text" value="{{old('name')}}" name="name"
                                class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>Email address*</label>
                            <input maxlength="191" value="{{old('email')}}" name="email" required type="email"
                                class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input value="{{old('phone')}}" name="phone" type="text" class="form-control"
                                placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input maxlength="191" value="{{old('address')}}" name="address" type="text"
                                class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label>Password*</label>
                            <input required name="password" minlength="8" type="password" class="form-control"
                                placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password*</label>
                            <input required name="password_confirmation" minlength="8" type="password"
                                class="form-control" placeholder="ConfirmPassword">
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control" accept="image/*">
                        </div>
                        <div class="form-footer pt-4 pt-2 mt-4 border-top">
                            <button type="submit" class="mb-1 btn btn-success">
                                <i class=" mdi mdi-checkbox-marked-outline mr-1"></i> Register
                            </button>
                            <div class="pull-right">
                                Already have an account? <a href="{{route('login')}}">Login here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection