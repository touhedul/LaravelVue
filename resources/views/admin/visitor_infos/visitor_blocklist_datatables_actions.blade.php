<div class='btn-group'>

    @can('Visitor-block-remove')

    <a href="{{route('admin.visitorRemoveFromBlockList',$dataTable->id)}}" class="btn btn-sm btn-danger ">Remove From Block</a>
    @endcan


</div>
