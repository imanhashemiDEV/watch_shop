<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public function render()
    {
        $brands = Brand::query()->paginate(10);
        return view('livewire.admin.brands', compact('brands'));
    }
}
