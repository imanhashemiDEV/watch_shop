<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public function render()
    {
        $tags = Tag::query()->paginate(10);
        return view('livewire.admin.tags', compact('tags'));
    }
}
