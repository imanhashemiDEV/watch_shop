<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TagController extends Controller
{
    public function index()
    {

        return view('admin.tag.index');
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $tag = Tag::query()->create([
            'title' => $request->input('title'),
        ]);
        return redirect()->back()->with('message', 'تگ با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = Tag::query()->find($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        Tag::query()->find($id)->update([
            'title' => $request->input('title'),
        ]);
        return redirect()->route('tags.index')->with('message', 'تگ با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Tag::destroy($id);
        return redirect()->back()->with('message', 'تگ با موفقیت حذف شد');
    }
}
