<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CompanyRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Company;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::query()->paginate(10);
        return  view('admin.article.index',compact('articles'));
    }


    public function create()
    {
        $categories=Category::query()->where('parent_id','!=',0)->pluck('title','id');
         $tags = Tag::pluck('title', 'id');
        return view('admin.article.create',compact('categories','tags'));
    }


    public function store(ArticleRequest $request)
    {

        if ($file = $request->file('image')) {
            $name = 'HSEPLUS' . time() . '.jpg';
            $smallImage = Image::make($file->getRealPath());
            $bigImage = Image::make($file->getRealPath());

            $smallImage->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });
            $upload = Storage::disk('public')->put('articles/small/' . $name, (string)$smallImage->encode('jpg', 90));
            $upload2 = Storage::disk('public')->put('articles/big/' . $name, (string)$bigImage->encode('jpg', 90));
        }

        $tags = $request->tags;

       $article =  Article::query()->create([
            'title'=>$request->input('title'),
            'slug'=>make_slug($request->input('title')),
            'description'=>$request->input('description'),
            'category_id'=>$request->input('category_id'),
            'user_id'=>auth()->user()->id,
            'image'=> $name ?? null
        ]);

        $article->tags()->attach($tags);

        return redirect()->back()->with('message','مقاله با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $article = Article::query()->find($id);
        $tags = Tag::pluck('title', 'id');
        $categories=Category::query()->where('parent_id','!=',0)->pluck('title','id');
        return view('admin.article.edit',compact('article','categories','tags'));
    }


    public function update(ArticleRequest $request, $id)
    {

        if ($file = $request->file('image')) {
            $name = 'HSEPLUS' . time() . '.jpg';
            $smallImage = Image::make($file->getRealPath());
            $bigImage = Image::make($file->getRealPath());

            $smallImage->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });
            $upload = Storage::disk('public')->put('articles/small/' . $name, (string)$smallImage->encode('jpg', 90));
            $upload2 = Storage::disk('public')->put('articles/big/' . $name, (string)$bigImage->encode('jpg', 90));
        }

        $article =  Article::query()->find($id);

           $article->update([
            'title'=>$request->input('title'),
            'slug'=>make_slug($request->input('title')),
            'description'=>$request->input('description'),
            'category_id'=>$request->input('category_id'),
            'user_id'=>auth()->user()->id,
            'image'=> $name ?? $article->image
        ]);

        $tags = $request->tags;

        $article->tags()->sync($tags);

        return redirect()->route('articles.index')->with('message','مقاله با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return redirect()->back()->with('message','مقاله با موفقیت حذف شد');
    }
}
