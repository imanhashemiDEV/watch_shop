<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Sliders extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public function render()
    {
        $sliders = Slider::query()->paginate(10);
        return view('livewire.admin.sliders', compact('sliders'));
    }
}
