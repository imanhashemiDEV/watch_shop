<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    public function index()
    {
        $provinces = Province::query()->paginate(20);
        return view('admin.provinces.index', compact('provinces'));
    }


    public function create()
    {
        return view('admin.provinces.create');
    }


    public function store(ProvinceRequest $request)
    {
        $province = new Province();
        $province->name = $request->input('name');
        $province->save();
        return redirect()->back()->with('message', 'استان جدید با موفقیت اضافه شد');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $province = Province::query()->findOrFail($id);
        return view('admin.provinces.edit', compact('province'));
    }


    public function update(ProvinceRequest $request, $id)
    {
        $province = Province::query()->findorfail($id);
        $province->name = $request->input('name');
        $province->save();

        return redirect()->route('provinces.index')->with('message', 'استان  با موفقیت ویرایش شد');
    }


    public function destroy($id)
    {
        $province = Province::query()->findOrFail($id);
        $province->delete();
    }

    public function searchProvince(Request $request)
    {
        $search = $request->input('search');
        $provinces = Province::query()->latest()
            ->where('name', 'like', '%' . $search . '%')
            ->paginate(10);
        return view('admin.provinces.index', compact('provinces'));
    }
}
