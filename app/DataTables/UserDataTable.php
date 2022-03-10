<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class UserDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.users.datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('status',function($dataTable){
                $active = '<div class="mb-2 mr-2 badge badge-success">Active</div>';
                $deactive = '<div class="mb-2 mr-2 badge badge-danger">Deactive</div>';
                return $dataTable->status == 1 ? $active : $deactive;
            })
            // ->addColumn('image', function ($dataTable) {
            //     return "<img src='" . asset('images/avatar-' . $dataTable->image) . "'/>";
            // })
            // ->addColumn('file',function($dataTable){
            //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
            // })
            ->rawColumns(['action', 'image','status']);
    }

    public function query(User $model)
    {
        return $model->newQuery()->role('user')->latest();
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'lBfrtip',
                'lengthMenu' => [[20, 40, 60, 100, -1], ['20', '40', '60', '100', 'All']],
                'stateSave' => true,
                'oLanguage' => [
                    'sLengthMenu' => "_MENU_",
                ],
                'buttons' => ['csv', 'excel', 'print', 'reset'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'Sl', 'name',
            'email',
            'phone',
            'address',
            'status',
            // 'image'
        ];
    }

    protected function filename()
    {
        return 'users_datatable_' . time();
    }
}
