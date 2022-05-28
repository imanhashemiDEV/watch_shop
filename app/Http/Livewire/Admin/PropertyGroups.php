<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\PropertyGroup;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyGroups extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public $search = '';
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyPropertyGroup',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyPropertyGroup($id)
    {
        PropertyGroup::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deletePropertyGroup($id)
    {
        $this->dispatchBrowserEvent('deletePropertyGroup',['id'=>$id]);
    }

    public function render()
    {
        $property_groups = PropertyGroup::query()->orderBy('id','DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);
        return view('livewire.admin.property-groups',compact('property_groups'));
    }
}
