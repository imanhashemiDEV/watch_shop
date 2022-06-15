<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyComment',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyComment($id)
    {
        Comment::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteComment($id)
    {
        $this->dispatchBrowserEvent('deleteComment', ['id'=>$id]);
    }

    public function changeStatus($id)
    {
        $comment = Comment::query()->find($id);
        if ($comment->status === 'accepted') {
            $comment->status = 'rejected';
            $comment->save();
        } elseif ($comment->status === 'rejected') {
            $comment->status = 'accepted';
            $comment->save();
        } elseif ($comment->status === 'draft') {
            $comment->status = 'accepted';
            $comment->save();
        }
    }

    public function render()
    {
        $comments = Comment::with('product')->orderBy('created_at', 'desc')
        ->where('body', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.comments', compact('comments'));
    }
}
