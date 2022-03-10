<?php

namespace App\DataTables;

use App\Models\ContactFeedback;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class ContactDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.contact_feedbacks.datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('message', function ($dataTable) {
                return Str::limit($dataTable->message, 50);
            });
        // ->addColumn('image', function ($dataTable) {
        //     return "<img src='".asset('images/'.$dataTable->image)."'/>";
        // })
        // ->addColumn('file',function($dataTable){
        //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
        // })
        // ->rawColumns(['details', 'action', 'image', 'file']);
    }

    public function query(ContactFeedback $model)
    {
        return $model->newQuery()->whereNotNull('phone')->latest();
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
                'buttons' => [ 'csv', 'excel', 'print', 'reset'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'Sl', 'name',
            'email', 'phone', 'message',
        ];
    }

    protected function filename()
    {
        return 'contacts_datatable_' . time();
    }
}


