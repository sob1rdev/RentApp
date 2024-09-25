<?php

namespace App\View\Components;

use App\Models\Branch;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Collection;

class AdForm extends Component
{
    public $action = "/ads";
    public $ad;
    public $branches = [];
    public function __construct()
    {
        $this->branches = Branch::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ad-form');
    }
}
