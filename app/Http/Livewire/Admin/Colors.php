<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Colors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyColor',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyColor($id)
    {
        Color::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteColor($id)
    {
        $this->dispatchBrowserEvent('deleteColor', ['id'=>$id]);
    }

    public function render()
    {
        $colors = Color::query()->orderBy('id', 'DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.colors', compact('colors'));
    }
}
