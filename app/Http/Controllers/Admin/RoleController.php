<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.roles.roles');
    }


    public function create()
    {
        return view('admin.roles.create_role');
    }


    public function store(RoleRequest $request)
    {
        Role::create([
            'name' => $request->name
            ]);

        return redirect()->back()->with('message','نقش با موفقیت اضافه شد');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $role = Role::query()->find($id);
        return view('admin.roles.update_role',compact('role'));

    }


    public function update(RoleRequest $request, $id)
    {
        Role::query()->find($id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('roles.index')->with('message','نقش با موفقیت ویرایش شد');
    }


    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->back()->with('message','نقش با موفقیت حذف شد');
    }

    public function createRolePermission($id)
    {
        $role = Role::query()->find($id);
        $permissions = Permission::query()->get();
        return view('admin.roles.create_role_permissions',compact('permissions','role'));
    }

    public function storeRolePermission(Request $request , $id)
    {
       $role = Role::query()->find($id);
       $role->syncPermissions($request->permissions);
       return redirect()->back()->with('message','مجوزها با موفقیت به نقش متصل شدند ');
    }
}
