<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::query()->paginate(20);
        return view('admin.cities.index', compact('cities'));
    }


    public function create()
    {
        $provinces = Province::query()->pluck('name', 'id');
        return view('admin.cities.create', compact('provinces'));
    }


    public function store(CityRequest $request)
    {
        $city = new City();
        $city->name = $request->input('name');
        $city->province_id = $request->input('province_id');
        $city->save();

        return redirect()->back()->with('message', 'شهر جدید با موفقیت اضافه شد');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $provinces = Province::query()->pluck('name', 'id');
        $city = City::query()->findOrFail($id);
        return view('admin.cities.edit', compact('city', 'provinces'));
    }


    public function update(CityRequest $request, $id)
    {
        $city = City::query()->findorfail($id);
        $city->name = $request->input('name');
        $city->province_id = $request->input('province_id');
        $city->save();

        return redirect()->route('cities.index')->with('message', 'شهر جدید با موفقیت ویرایش شد');
    }


    public function destroy($id)
    {
        $city = City::query()->findOrFail($id);
        $city->delete();
    }

    public function searchCity(Request $request)
    {
        $search = $request->input('search');
        $cities = City::query()->latest()
            ->where('name', 'like', '%' . $search . '%')
            ->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }
}
