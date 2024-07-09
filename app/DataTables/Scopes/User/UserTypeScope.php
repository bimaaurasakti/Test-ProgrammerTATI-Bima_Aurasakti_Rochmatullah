<?php

namespace App\DataTables\Scopes\User;

use Yajra\DataTables\Contracts\DataTableScope;

class UserTypeScope implements DataTableScope
{
    private $user_type;

    public function __construct($user_type)
    {
        $this->user_type = $user_type;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->where('users.user_type', $this->user_type);
    }
}
