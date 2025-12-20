<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class Sidebar extends Component
{
    public $totalCatatanPasien;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->totalCatatanPasien = 0;
        
        // Catatan system removed - set to 0
        if (auth()->check() && auth()->user()->role === 'admin') {
            $this->totalCatatanPasien = 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar');
    }
}
