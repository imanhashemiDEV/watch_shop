<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return  view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        $image = User::saveImage($request->image);

        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'profile_photo_path'=>$image,
        ]);

        return redirect()->back()->with('message', 'کاربر با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::query()->find($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::query()->find($id);

        $image = User::saveImage($request->image);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'profile_photo_path'=>$image,
        ]);

        return redirect()->route('users.index')->with('message', 'کاربر با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
    }

    public function createUserRoles($id)
    {
        $user = User::query()->find($id);
        $roles = Role::query()->get();

        return view('admin.user.create_user_roles', compact('user', 'roles'));
    }

    public function storeUserRoles(Request $request, $id)
    {
        $user = User::query()->find($id);
        $user->syncRoles($request->roles);

        return redirect()->back()->with('message', 'نقش ها با موفقیت به کاربر متصل شدند ');
    }

    public function findUserByProperty(Request $request)
    {
        $result = [];
        if ($request->has('word')) {
            $term = trim($request->word);
            $users = User::query()->where('mobile', 'like', '%'.$term.'%')->
            orWhere('email', 'like', '%'.$term.'%')->
            orWhere('name', 'like', '%'.$term.'%')->get();

            foreach ($users as $user) {
                $result['items'][] = [
                    'id' => $user->id,
                    'text' => $user->mobile.'  ---  '.$user->name.'  ---  '.$user->email,
                ];
            }
        }

        return json_encode($result, true);
    }
}
