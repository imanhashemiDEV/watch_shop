<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyBrand',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyBrand($id)
    {
        Brand::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteBrand($id)
    {
        $this->dispatchBrowserEvent('deleteBrand', ['id'=>$id]);
    }

    public function render()
    {
        $brands = Brand::query()->orderBy('id', 'DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.brands', compact('brands'));
    }
}
