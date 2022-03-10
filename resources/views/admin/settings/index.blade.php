@extends('layouts.admin')
@section('title')Settings @endsection
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="{{$icon}} icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div> Settings</div>
        </div>
    </div>
</div>
<form id="settingsForm" method="POST" action="{{ route('admin.settings.updateAll') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        {{-- General Setting --}}
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header"> <span class="text-primary"> General Setting </span> </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input required type="text" name="site_title" id="site_title" class="form-control"
                            value="{{ env('APP_NAME') }}">
                    </div>
                    <div class="form-group">
                        <label for="site_title">Site Description</label>
                        <input required type="text" name="site_description" id="site_description" class="form-control"
                            value="{{ $settings->where('name','site_description')->first()->value ?? old('site_description') }}">
                    </div>

                    <div class="form-group">
                        <label for="site_logo">Logo (Only Image are allowed, Size: 100 X 50))</label><br><br>
                        <img src="{{asset('images/'.$settings->where('name','site_logo')->first()->value)}}"
                            alt="" /><br><br>
                        <input type="file" name="site_logo" id="site_logo" class="form-control dropify">
                    </div>

                    <div class="form-group">
                        <label for="site_favicon">Favicon (Only Image are allowed, Size: 33 X 33))</label><br><br>
                        <img src="{{asset('images/'.$settings->where('name','site_favicon')->first()->value)}}"
                            alt="" /><br><br>
                        <input type="file" name="site_favicon" id="site_favicon" class="form-control dropify">
                    </div>

                    @can('setting-update')
                    <button type="button" class="btn btn-danger"
                        onclick="document.getElementById('settingsForm').reset();">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        <span>Update</span>
                    </button>
                    @endcan
                </div>
            </div>

        </div>
        {{-- Mail Setting --}}
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header"> <span class="text-primary"> Mail Setting </span> </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="mail_mailer">Mail Mailer</label>
                        <input type="text" name="mail_mailer" id="mail_mailer" class="form-control"
                            value="{{env('MAIL_MAILER') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_host">Mail Host</label>
                        <input type="text" name="mail_host" id="mail_host" class="form-control"
                            value="{{env('MAIL_HOST') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_port">Mail Port</label>
                        <input type="text" name="mail_port" id="mail_port" class="form-control"
                            value="{{env('MAIL_PORT') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_username">Mail Username</label>
                        <input type="text" name="mail_username" id="mail_username" class="form-control"
                            value="{{env('MAIL_USERNAME') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_password">Mail Password</label>
                        <input type="password" name="mail_password" id="mail_password" class="form-control"
                            value="{{env('MAIL_PASSWORD') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_encryption">Mail Encryption</label>
                        <input type="text" name="mail_encryption" id="mail_encryption" class="form-control"
                            value="{{env('MAIL_ENCRYPTION') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_from_address">Mail From Address</label>
                        <input type="text" name="mail_from_address" id="mail_from_address" class="form-control"
                            value="{{env('MAIL_FROM_ADDRESS') }}">
                    </div>
                    <div class="form-group">
                        <label for="mail_from_name">Mail From Name</label>
                        <input type="text" name="mail_from_name" id="mail_from_name" class="form-control"
                            value="{{env('MAIL_FROM_NAME') }}">
                    </div>
                    @can('setting-update')
                    <button type="button" class="btn btn-danger"
                        onclick="document.getElementById('settingsForm2').reset();">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        <span>Update</span>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
        {{-- Social Media Setting --}}
        {{-- <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header"> <span class="text-primary"> Social Media Setting </span> </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control"
                            value="{{ $settings->where('name','facebook')->first()->value ?? old('facebook') }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control"
                            value="{{ $settings->where('name','instagram')->first()->value ?? old('instagram') }}">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" name="twitter" id="twitter" class="form-control"
                            value="{{ $settings->where('name','twitter')->first()->value ?? old('twitter') }}">
                    </div>
                    <div class="form-group">
                        <label for="youtube">Youtube</label>
                        <input type="text" name="youtube" id="youtube" class="form-control"
                            value="{{ $settings->where('name','youtube')->first()->value ?? old('youtube') }}">
                    </div>

                    @can('setting-update')
                    <button type="button" class="btn btn-danger"
                        onclick="document.getElementById('settingsForm2').reset();">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        <span>Update</span>
                    </button>
                    @endcan
                </div>
            </div>
        </div> --}}
        {{-- Social Media Login Setting --}}
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header"> <span class="text-primary"> Social Media Login Setting </span> </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="facebook_client_id">Facebook Client Id</label>
                        <input type="text" name="facebook_client_id" id="facebook_client_id" class="form-control"
                            value="{{ env('FACEBOOK_CLIENT_ID')}}">
                    </div>
                    <div class="form-group">
                        <label for="facebook_client_secret">Facebook Client Secret</label>
                        <input type="text" name="facebook_client_secret" id="facebook_client_secret"
                            class="form-control"
                            value="{{ env('FACEBOOK_CLIENT_SECRET')}}">
                    </div>
                    <div class="form-group">
                        <label for="google_client_id">Google Client Id</label>
                        <input type="text" name="google_client_id" id="google_client_id" class="form-control"
                            value="{{ env('GOOGLE_CLIENT_ID')}}">
                    </div>
                    <div class="form-group">
                        <label for="google_client_secret">Google Client Secret</label>
                        <input type="text" name="google_client_secret" id="google_client_secret"
                            class="form-control"
                            value="{{ env('GOOGLE_CLIENT_SECRET')}}">
                    </div>

                    @can('setting-update')
                    <button type="button" class="btn btn-danger"
                        onclick="document.getElementById('settingsForm2').reset();">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        <span>Update</span>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
@include('includes.dropify')
