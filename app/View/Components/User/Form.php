<?php

namespace App\View\Components\User;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Form extends Component
{
    public $id, $type, $user, $role;

    /**
     * Create a new component instance.
     */
    public function __construct($id = '', $type = 'customer', $user = new User(), $role = [])
    {
        $this->id = $id;
        $this->type = $type;
        $this->user = $user;
        $this->role = $role; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('users.components.form');
    }
}
