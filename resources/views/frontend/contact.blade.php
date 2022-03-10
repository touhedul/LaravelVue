@extends('layouts.frontend')
@section('title','Contact Us')
@section('content')
<br>
<div class="container">
    <div class="col-md-6"><br>
        <h3>{{ __('Contact Us') }}</h3><br>
        <form class="contact-form" data-parsley-validate method="POST" action="{{route('submit.feedback')}}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Name') }}*</label>
                @guest
                <input data-parsley-trigger="change" value="{{old('name')}}" required type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="nameHelp" placeholder="Enter name">
                @else
                <input data-parsley-trigger="change" required type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->name}}" name="name" aria-describedby="nameHelp" placeholder="Enter name">
                @endguest

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Email address') }}*</label>
                @guest
                <input data-parsley-trigger="change" value="{{old('email')}}" required type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                @else
                <input data-parsley-trigger="change" required type="email" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->email}}" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                @endguest

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Phone') }}*</label>
                <input data-parsley-trigger="change" required value="{{old('phone')}}" required type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" placeholder="Enter phone">

            </div>
            <div class="form-group">
                {{ __('Message') }}*
                <textarea name="message" required class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('message')}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
<br>
@endsection
