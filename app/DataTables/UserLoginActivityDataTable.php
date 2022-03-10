<?php

namespace App\DataTables;

use App\Models\LoginActivity;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class UserLoginActivityDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('user', function ($dataTable) {
                return $dataTable->user->name;
            })
            ->addColumn('last_login', function ($dataTable) {
                $dateTime = date('d/M/Y h:i a', strtotime($dataTable->updated_at));
                $difference = $dataTable->updated_at->diffForHumans();
                return $dateTime." (".$difference.")";
            })
            ->addColumn('action', function($dataTable){
                return view('admin.activity_logs.datatables_actions',compact('dataTable'));
            })
            // ->addColumn('image', function ($dataTable) {
            //     return "<img src='" . asset('images/avatar-' . $dataTable->image) . "'/>";
            // })
            // ->addColumn('file',function($dataTable){
            //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
            // })
            ->rawColumns(['action', 'image', 'status']);
    }

    public function query(LoginActivity $model)
    {
        // return $model->newQuery()->role('user')->latest();
        $userIds = User::role('user')->pluck('id');
        return $model->newQuery()->whereIn('user_id',$userIds)->with('user')->latest();
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
            'Sl', 'user', 'user_agent', 'ip_address', 'last_login'
            // 'image'
        ];
    }

    protected function filename()
    {
        return 'user_login_activity_datatable_' . time();
    }
}
