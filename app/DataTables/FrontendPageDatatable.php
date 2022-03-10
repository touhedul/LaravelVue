<?php

namespace App\DataTables;

use App\Models\ContactFeedback;
use App\Models\FrontendPage;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class FrontendPageDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable
            ->addIndexColumn()
            ->addColumn('action', function ($dataTable) {
                if(auth()->user()->can('Page-update')){

                    return '<a class="btn btn-sm btn-primary" href="'.route('admin.frontendCMS.pageEdit',$dataTable->id).'" >Edit</a>';
                }else{
                    return 'No action permit';
                }
            })
            ->addColumn('Sl', '')
            ->addColumn('name', function ($dataTable) {
                return ucfirst(str_replace('_',' ',$dataTable->name));
            })
            ->addColumn('content', function ($dataTable) {
                return Str::limit($dataTable->content, 50);
            })
            // ->addColumn('image', function ($dataTable) {
            //     return "<img src='".asset('images/'.$dataTable->image)."'/>";
            // })
            // ->addColumn('file',function($dataTable){
            //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
            // })
            ->rawColumns(['content', 'action', 'image', 'file']);
    }

    public function query(FrontendPage $model)
    {
        return $model->newQuery()->latest();
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
            'content'
        ];
    }

    protected function filename()
    {
        return 'contacts_datatable_' . time();
    }
}
