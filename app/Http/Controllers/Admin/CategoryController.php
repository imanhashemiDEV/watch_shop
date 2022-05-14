<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::query()->paginate(10);
        return  view('admin.category.index',compact('categories'));
    }


    public function create()
    {
        $categories=Category::query()->pluck('title','id');
        return view('admin.category.create',compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        $category = Category::query()->create([
            'title'=>$request->input('title'),
            'slug'=>make_slug($request->input('title')),
            'parent_id'=>$request->input('parent_id')
        ]);

        return redirect()->back()->with('message','دسته بندی با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $category = Category::query()->find($id);
        $categories=Category::query()->pluck('title','id');
        return view('admin.category.edit',compact('category','categories'));
    }


    public function update(Request $request, $id)
    {
       $category = Category::query()->find($id)->update([
           'title'=>$request->input('title'),
           'slug'=>make_slug($request->input('title')),
           'parent_id'=>$request->input('parent_id')
       ]);

        return redirect()->route('categories.index')->with('message','دسته بندی با موفقیت ویرایش شد');

    }

    public function destroy($id)
    {
        Category::destroy($id);
    }

}
