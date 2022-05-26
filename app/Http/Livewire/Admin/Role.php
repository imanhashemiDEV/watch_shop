<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public $search = '';
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyRole',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyRole($id)
    {
        \Spatie\Permission\Models\Role::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteRole($id)
    {
        $this->dispatchBrowserEvent('deleteRole',['id'=>$id]);
    }

    public function render()
    {
        $roles = \Spatie\Permission\Models\Role::query()->orderBy('id','DESC')
        ->where('name', 'like', '%'.$this->search.'%')->paginate(30);
        return view('livewire.admin.role',compact('roles'));
    }
}
