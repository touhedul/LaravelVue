<?php

namespace App\DataTables;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class RoleDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable
            // ->addColumn('action', 'admin.roles.datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('name', function($dataTable){
                return ucfirst($dataTable->name);
            })
            ->addColumn('permissions', function($dataTable){
                $permissionName = "";
                foreach($dataTable->permissions as $permission){
                    $permissionName .=  "<span class='badge badge-default mr-1'> ".$permission->name." </span>";
                }
                return $permissionName;
            })
            ->addColumn('action', function($dataTable){
                    return view('admin.roles.datatables_actions',compact('dataTable'));

            })
        // ->addColumn('details',function($dataTable){
        //     return Str::limit($dataTable->details,50);
        // })
        // ->addColumn('image', function ($dataTable) {
        //     return "<img src='".asset('images/'.$dataTable->image)."'/>";
        // })
        // ->addColumn('file',function($dataTable){
        //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
        // })
        ->rawColumns(['permissions','action']);
    }

    public function query(Role $model)
    {
        return $model->newQuery()->where('name','!=','super-admin')->where('name','!=','user')->oldest();
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
            'Sl', 'name','description','permissions'
        ];
    }

    protected function filename()
    {
        return 'roles_datatable_' . time();
    }
}
