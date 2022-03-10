<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    <select name="roles[]" id="" class="form-control select2" multiple required>
        @foreach ($roles as $role)
        <option
        @isset($admin)

        {{$admin->hasRole($role->name) == 1 ? 'selected':'' }}
        @endisset
            value="{{$role->name}}">{{$role->name}}</option>
        @endforeach
    </select>
</div>
<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 191,'minlength' => 8]) !!}
</div>

<!-- Submit Field -->
<div class="form-group">
    {{ Form::button('<i class="fas fa-plus-circle"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-primary '] )  }}
    <a href="{{ route('admin.admins.index') }}" class="btn btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Cancel</a>
</div>

{{-- @include('includes.ckeditor') --}}
@section('script')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection

