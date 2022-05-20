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
        if($comment->status==0){
            $comment->status=1;
            $comment->save();

        }else{
            $comment->status=0;
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
