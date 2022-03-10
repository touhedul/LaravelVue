<?php

namespace App\DataTables;

use App\Models\LoginActivity;
use App\Models\User;
use App\Models\VisitorInfo;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class VisitorInfoDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('last_visit', function ($dataTable) {
                $dateTime = date('d/M/Y h:i a', strtotime($dataTable->updated_at));
                $difference = $dataTable->updated_at->diffForHumans();
                return $dateTime." (".$difference.")";
            })
            ->addColumn('action', function($dataTable){
                return view('admin.visitor_infos.datatables_actions',compact('dataTable'));
            })
            // ->addColumn('image', function ($dataTable) {
            //     return "<img src='" . asset('images/avatar-' . $dataTable->image) . "'/>";
            // })
            // ->addColumn('file',function($dataTable){
            //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
            // })
            ->rawColumns(['action', 'image', 'status']);
    }

    public function query(VisitorInfo $model)
    {
        return $model->newQuery()->where('status',1)->latest();
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
            'Sl', 'user_agent', 'ip_address','count','last_visit'
            // 'image'
        ];
    }

    protected function filename()
    {
        return 'visitor_info_datatable_' . time();
    }
}
