<!-- Name Field -->
<div class="form-group">
    <b>{!! Form::label('name', 'Name:') !!}</b>
    <p>{{ $language->name }}</p>
</div>

<!-- Code Field -->
<div class="form-group">
    <b>{!! Form::label('code', 'Code:') !!}</b>
    <p>{{ $language->code }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    <b>{!! Form::label('status', 'Status:') !!}</b>


    @if ($language->status)
    <div class="mb-2 mr-2 badge badge-success">Active</div>
    @else
    <div class="mb-2 mr-2 badge badge-danger">Deactive</div>
    @endif
</div>

<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', 'Created At:') !!}</b>
    <p>{{ $language->created_at->toFormattedDateString() }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', 'Updated At:') !!}</b>
    <p>{{ $language->updated_at->toFormattedDateString() }}</p>
</div>

