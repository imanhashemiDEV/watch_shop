<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function index()
    {

        return view('admin.color.index');
    }


    public function create()
    {
        return view('admin.color.create');
    }


    public function store(ColorRequest $request)
    {
        Color::query()->create([
            'title'=>$request->input('title'),
            'code'=>$request->input('code')
        ]);

        return redirect()->back()->with('message','رنگ با موفقیت اضافه شد');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $color = Color::query()->find($id);
        return view('admin.color.edit',compact('color'));
    }


    public function update(ColorRequest $request, $id)
    {
        Color::query()->find($id)->update([
            'title'=>$request->input('title'),
            'code'=>$request->input('code')
        ]);

        return redirect()->back()->with('message','رنگ با موفقیت ویرایش شد');
    }


    public function destroy($id)
    {
         Color::destroy($id);
    }
}
