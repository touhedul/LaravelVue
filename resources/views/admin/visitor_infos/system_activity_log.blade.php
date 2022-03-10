@extends('layouts.admin')
@section('title')System Activity Log @endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diamond icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div> System Activity Log</div>
        </div>
        @can('log-activity-delete')
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <a href="#" onclick="if(confirm('Are You sure to delete !')){
                    event.preventDefault();
                document.getElementById('login-activity-form').submit();}"
                type="button" class="btn-shadow btn btn-danger">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fas fa-plus-circle fa-w-20"></i>
                    </span>
                    Delete All Activity
                </a>
            </div>
        </div>
        <form id="login-activity-form" action="{{route('admin.deleteAllSystemLogActivity')}}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        @endcan
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="table-responsive">
                    @include('admin.activity_logs.system_activity_log_table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
