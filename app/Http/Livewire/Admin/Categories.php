<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public $search = '';
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyCategory',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyCategory($id)
    {
        Category::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteCategory($id)
    {
        $this->dispatchBrowserEvent('deleteCategory',['id'=>$id]);
    }

    public function render()
    {
        $categories = Category::query()->orderBy('id','DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);
        return view('livewire.admin.categories', compact('categories'));
    }
}
