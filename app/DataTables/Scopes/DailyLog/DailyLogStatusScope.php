<?php

namespace App\DataTables\Scopes\DailyLog;

use Yajra\DataTables\Contracts\DataTableScope;

class DailyLogStatusScope implements DataTableScope
{
    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->where('daily_logs.status', $this->status);
    }
}
