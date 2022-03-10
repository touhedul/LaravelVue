@extends('layouts.admin')
@section('title')View Contacts @endsection
@section('content')
@include('includes.page_header',['title'=>'View Contacts','url'=>route('admin.contacts'),'icon' =>
'pe-7s-network'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <!-- Name Field -->
                <div class="form-group">
                    <b>{!! Form::label('name', 'Name:') !!}</b>
                    <p>{{ $contactFeedback->name }}</p>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <b>{!! Form::label('email', 'Email:') !!}</b>
                    <p>{{ $contactFeedback->email }}</p>
                </div>

                <!-- phone Field -->
                <div class="form-group">
                    <b>{!! Form::label('phone', 'Phone:') !!}</b>
                    <p>{{ $contactFeedback->phone }}</p>
                </div>

                <!-- message Field -->
                <div class="form-group">
                    <b>{!! Form::label('message', 'Message:') !!}</b>
                    <p>{{ $contactFeedback->message }}</p>
                </div>


                <!-- Created At Field -->
                <div class="form-group">
                    <b>{!! Form::label('created_at', 'Time:') !!}</b>
                    <p>{{ $contactFeedback->created_at->toFormattedDateString() }}</p>
                </div>

                <a href="{{ route('admin.contacts') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i>
                    Back</a>
            </div>
        </div>
    </div>
</div>
@endsection