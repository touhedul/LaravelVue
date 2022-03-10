@extends('layouts.admin')
@section('title')View  System Administrator Details @endsection
@section('content')
@include('includes.page_header',['title'=>'View System Administrator','url'=>route('admin.admins.index'),'icon' => 'pe-7s-user','permission'=>'admin-view'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    @include('admin.admins.show_fields')
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
