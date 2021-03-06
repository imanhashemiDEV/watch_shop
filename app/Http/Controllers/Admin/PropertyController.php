<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index');
    }

    public function create()
    {
        $property_groups = PropertyGroup::query()->pluck('title', 'id');

        return view('admin.properties.create', compact('property_groups'));
    }

    public function store(Request $request)
    {
        Property::query()->create([
            'title'=>$request->title,
            'property_group_id'=>$request->property_group_id,
        ]);

        return redirect()->back()->with('message', 'ویژگی با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $property_groups = PropertyGroup::query()->pluck('title', 'id');
        $property = Property::query()->find($id);

        return view('admin.properties.edit', compact('property_groups', 'property'));
    }

    public function update(Request $request, $id)
    {
        Property::query()->find($id)->update([
            'title'=>$request->title,
            'property_group_id'=>$request->property_group_id,
        ]);

        return redirect()->back()->with('message', ' ویژگی با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Property::destroy($id);

        return redirect()->back();
    }
}
