<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyGroupController extends Controller
{
    public function index()
    {
        return  view('admin.property_group.index');
    }

    public function create()
    {
        $categories = Category::query()->pluck('title', 'id');

        return view('admin.property_group.create', compact('categories'));
    }

    public function store(Request $request)
    {
        PropertyGroup::query()->create([
            'title'=>$request->title,
            // 'category_id'=>$request->category_id
        ]);

        return redirect()->back()->with('message', 'گروه ویژگی ها با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::query()->pluck('title', 'id');
        $property_group = PropertyGroup::query()->find($id);

        return view('admin.property_group.edit', compact('property_group', 'categories'));
    }

    public function update(Request $request, $id)
    {
        PropertyGroup::query()->find($id)->update([
            'title'=>$request->title,
            // 'category_id'=>$request->category_id
        ]);

        return redirect()->back()->with('message', 'گروه ویژگی ها با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        PropertyGroup::destroy($id);

        return redirect()->back();
    }
}
