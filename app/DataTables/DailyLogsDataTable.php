<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\DailyLog;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Dictionaries\DailyLogStatusDictionary;
use App\Dictionaries\Users\UserTypeDictionary;
use App\DataTables\Scopes\DailyLog\DailyLogStatusScope;

class DailyLogsDataTable extends DataTable
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
            ->editColumn('activity', function($query) {
                return Str::limit($query->activity, 100, '...');
            })
            ->editColumn('status', function($query) {
                $style = 'primary';
                switch ($query->status) {
                    case DailyLogStatusDictionary::STATUS_ACCEPTED:
                        $style = 'success';
                        $status = 'Accepted';
                        break;
                    case DailyLogStatusDictionary::STATUS_PENDING:
                        $style = 'warning';
                        $status = 'Pending';
                        break;
                    default:
                        $style = 'danger';
                        $status = 'Rejected';
                }
                return '<span class="text-capitalize badge bg-'.$style.'">'.str_replace("_", " ", $status).'</span>';
            })
            ->editColumn('log_date', function($query) {
                return Carbon::parse($query->log_date)->format('d/m/Y');
            })
            ->addColumn('action', 'daily-logs.action')
            ->rawColumns(['action', 'status']);

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
        $model = DailyLog::query()
            ->select([
                'daily_logs.*',
                'users.manager_id AS manager_id',
                'users.user_type AS user_type'
            ])
            ->join('users', 'users.id', '=', 'daily_logs.user_id');

        if ($this->status) {
            $this->addScope(new DailyLogStatusScope($this->status));
        }

        if (in_array($this->user->user_type, UserTypeDictionary::GROUP_USER_TYPE_MANAGER)) {
            if ($this->menu == 'inferiors') {
                $model->where('users.manager_id', $this->user->id);
            } else {
                $model->where('daily_logs.user_id', $this->user->id);
            }
        } else if ($this->user->user_type == UserTypeDictionary::USER_TYPE_STAFF) {
            $model->where('daily_logs.user_id', $this->user->id);
        }

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
            ->setTableId('daily-logs-table')
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
            ['data' => 'activity', 'name' => 'activity', 'title' => 'Activity'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'log_date', 'name' => 'log_date', 'title' => 'Log Date'],
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
