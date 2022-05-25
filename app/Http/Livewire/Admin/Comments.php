<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comment;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public function changeStatus($id){
        $comment = Comment::query()->find($id);
        if($comment->status=='accepted'){
            $comment->status='rejected';
            $comment->save();
        }else if($comment->status=='rejected'){
            $comment->status='accepted';
            $comment->save();
        }else if($comment->status=='draft'){
            $comment->status='accepted';
            $comment->save();
        }
    }

    public function deleteComment($id){
        Comment::destroy($id);
    }

    public function render()
    {
        $comments = Comment::with('product')->orderBy('created_at', 'desc')->paginate(20);
        return view('livewire.admin.comments', compact('comments'));
    }
}
