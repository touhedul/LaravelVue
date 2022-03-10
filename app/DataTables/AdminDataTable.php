<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class AdminDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.admins.datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('role', function($dataTable){
                $roles="";
                foreach($dataTable->roles as $role){
                    $roles .= "<span class='badge badge-info mr-1'>". $role->name ." </span>";
                }
                return $roles;
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
        ->rawColumns(['role', 'action', 'image', 'file']);
    }

    public function query(User $model)
    {
        $role = Role::whereNotIn('name', ['user','super-admin'])->pluck('name');
        return $model->newQuery()->role($role)->with('roles')->latest();
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
            'email','role'
        ];
    }

    protected function filename()
    {
        return 'admins_datatable_' . time();
    }
}
