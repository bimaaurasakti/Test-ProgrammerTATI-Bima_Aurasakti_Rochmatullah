<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use App\DataTables\Scopes\User\UserTypeScope;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $datatables = datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('full_name', function($query) {
                return $query->first_name.' '.$query->last_name;
            })
            ->filterColumn('full_name', function($query, $keyword) {
                $sql = "CONCAT(first_name,' ',last_name)  like ?";
                return $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('user_type', function($query) {
                $status = 'primary';
                switch ($query->user_type) {
                    case 'admin':
                        $status = 'danger';
                        break;
                    case 'store_admin':
                        $status = 'info';
                        break;
                    case 'casier':
                        $status = 'dark';
                        break;
                    case 'customer':
                        $status = 'primary';
                        break;
                }
                return '<span class="text-capitalize badge bg-'.$status.'">'.str_replace("_", " ", $query->user_type).'</span>';
            })
            ->editColumn('is_active', function($query) {
                $style = 'primary';
                switch ($query->is_active) {
                    case 1:
                        $style = 'success';
                        $status = 'Active';
                        break;
                    default:
                        $style = 'danger';
                        $status = 'Disabled';
                }
                return '<span class="text-capitalize badge bg-'.$style.'">'.str_replace("_", " ", $status).'</span>';
            })
            ->addColumn('action', 'users.action')
            ->rawColumns(['action', 'user_type', 'is_active']);

        return $datatables;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = User::query();
        $this->addScope(new UserTypeScope($this->user_type));

        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return$this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'no', 'orderable' => false],
            ['data' => 'created_at', 'name' => 'created_at', 'visible' => false],
            ['data' => 'full_name', 'name' => 'full_name', 'title' => 'Full Name', 'orderable' => false],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'phone_number', 'name' => 'phone_number', 'title' => 'Phone Number'],
            ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];

        return $columns;
    }

}
