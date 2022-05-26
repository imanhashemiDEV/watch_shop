<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public $search = '';
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyUser',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyUser($id)
    {
        User::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteArticle($id)
    {
        $this->dispatchBrowserEvent('deleteUser',['id'=>$id]);
    }

    public function render()
    {
        $users = User::query()->orderBy('id','DESC')
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('mobile', 'like', '%'.$this->search.'%')
            ->where('email', 'like', '%'.$this->search.'%')
            ->paginate(30);
        return view('livewire.admin.users',compact('users'));
    }
}
