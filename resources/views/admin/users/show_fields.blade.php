<!-- Name Field -->
<div class="form-group">
    <b>{!! Form::label('name', 'Name:') !!}</b>
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    <b>{!! Form::label('email', 'Email:') !!}</b>
    <p>{{ $user->email }}</p>
</div>


<!-- Phone Field -->
<div class="form-group">
    <b>{!! Form::label('phone', 'Phone:') !!}</b>
    <p>{{ $user->phone }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    <b>{!! Form::label('address', 'Address:') !!}</b>
    <p>{{ $user->address }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    <b>{!! Form::label('address', 'Status:') !!}</b>
    @if ($user->status == 1)
    <div class="mb-2 mr-2 badge badge-success">Active</div>
    @else
    <div class="mb-2 mr-2 badge badge-danger">Deactive</div>
    @endif
</div>

<!-- Image Field -->
<div class="form-group">
    <b>{!! Form::label('image', 'Image:') !!}</b>
    <p><img src="{{asset('images/'.$user->image)}}" alt="No Image Found" /></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', 'Created At:') !!}</b>
    <p>{{ $user->created_at->toFormattedDateString() }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', 'Updated At:') !!}</b>
    <p>{{ $user->updated_at->toFormattedDateString() }}</p>
</div>