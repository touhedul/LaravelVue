@extends('layouts.admin')
@section('title')Create Setting @endsection
@section('content')
@include('includes.page_header',['title'=>'Create Setting','url'=>route('admin.settings.index'),'icon' => $icon])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    {!! Form::open(['route' => 'admin.settings.store']) !!}

                        @include('admin.settings.fields')

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

