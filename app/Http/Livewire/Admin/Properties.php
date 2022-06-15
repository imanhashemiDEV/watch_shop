<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class Properties extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyProperty',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyProperty($id)
    {
        Property::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteProperty($id)
    {
        $this->dispatchBrowserEvent('deleteProperty', ['id'=>$id]);
    }

    public function render()
    {
        $properties = Property::query()->orderBy('id', 'DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.properties', compact('properties'));
    }
}
