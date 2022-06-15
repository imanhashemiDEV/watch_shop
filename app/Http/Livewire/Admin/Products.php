<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyProduct',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyProduct($id)
    {
        Product::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteProduct($id)
    {
        $this->dispatchBrowserEvent('deleteProduct', ['id'=>$id]);
    }

    public function render()
    {
        $products = Product::query()->latest()
        ->where('title', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.products', compact('products'));
    }
}
