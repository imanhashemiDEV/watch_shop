<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Colors extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public function render()
    {
        $colors = Color::query()->paginate(10);
        return view('livewire.admin.colors',compact('colors'));
    }
}
