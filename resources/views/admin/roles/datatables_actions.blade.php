<div class='btn-group'>
    @can('role-update')
    <a href="{{ route('admin.roles.edit', $dataTable->id) }}" class='btn btn-sm btn-info'>
        Edit
    </a>
    @endcan
    @can('role-delete')
    @if ($dataTable->name != "admin")
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$dataTable->id}}" data-original-title="Delete" class="btn btn-sm btn-danger delete">Delete</a>
    @endif
    @endcan
    @cannot(['role-update','role-delete'])
    No Actiion Permit
    @endcannot
</div>
