<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Front
    public function saveComment(Request $request)
    {
        $article = Article::query()->find($request->article_id);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
       // $comment->parent_id = $request->parent_id;

        $article->comments()->save($comment);

        return redirect()->back()->with('message','نظر شما با موفقیت درج شد و در انتظار تایید قرار گرفت');
    }


    public function replyComment(Request $request)
    {

        $parentId = $request->input('parent_id');

        $article = Article::query()->findOrFail($request->input('article_id'));
        if($article){
            $comment = new Comment;
            $comment->body = $request->body;
            $comment->user_id = auth()->user()->id;
            $comment->parent_id = $request->parent_id;

            $article->comments()->save($comment);
        }
        return redirect()->back()->with('message','نظر شما با موفقیت درج شد و در انتظار تایید قرار گرفت');

    }


    // Panel

    public function index(){
        $comments = Comment::with('article')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.comment.index', compact('comments'));
    }

    public function update(Request $request, $id)
    {
        if($request->has('action')){
            if($request->input('action') == 'approved'){
                $comment = Comment::query()->findOrFail($id);
                $comment->status = 1;
                $comment->save();
                return redirect()->back()->with('message','نظر تایید شد');
            }else{
                $comment = Comment::query()->findOrFail($id);
                $comment->status = 0;
                $comment->save();
                return redirect()->back()->with('message','نظر عدم تایید شد');
            }
        }

    }

    public function destroy($id)
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('message','نظر حذف شد');
    }
}
