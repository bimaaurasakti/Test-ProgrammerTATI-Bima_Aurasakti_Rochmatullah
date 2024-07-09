<?php

namespace App\View\Components\Global;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormFooter extends Component
{
    public $id;
    public $backUrl;
    public $text;
    /**
     * Create a new component instance.
     */
    public function __construct($id = '', $backUrl = '', $text = '')
    {
        $this->id = $id;
        $this->backUrl = $backUrl;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('global.form-footer');
    }
}
