<?php

namespace App\DataTables;

use App\Models\Language;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class LanguageDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.languages.datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('status',function($dataTable){
                $active = '<div class="mb-2 mr-2 badge badge-success">Active</div>';
                $deactive = '<div class="mb-2 mr-2 badge badge-danger">Deactive</div>';
                return $dataTable->status == 1 ? $active : $deactive;
            })
            // ->addColumn('details',function($dataTable){
            //     return Str::limit($dataTable->details,50);
            // })
            // ->addColumn('image', function ($dataTable) {
            //     return "<img width='100px' height='80px' src='".asset('images/'.$dataTable->image)."'/>";
            // })
            // ->addColumn('file',function($dataTable){
            //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
            // })
            ->rawColumns(['status', 'action', 'image', 'file']);
    }

    public function query(Language $model)
    {
        return $model->newQuery()->orderBy('status','desc')->oldest();
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'lBfrtip',
                'lengthMenu' => [[20, 40, 50, 100, -1], ['20', '40', '50', '100', 'All']],
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
            'Sl','name',
            'code',
            'status'
        ];
    }

    protected function filename()
    {
        return 'languages_datatable_' . time();
    }
}
