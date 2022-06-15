<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyArticle',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyTag($id)
    {
        Tag::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteTag($id)
    {
        $this->dispatchBrowserEvent('deleteTag', ['id'=>$id]);
    }

    public function render()
    {
        $tags = Tag::query()->orderBy('id', 'DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.tags', compact('tags'));
    }
}
