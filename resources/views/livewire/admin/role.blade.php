<div class="table-responsive" tabindex="8">
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left"  dir="rtl" wire:model="search" >
        </div>
    </div>
    <table class="table table-striped table-hover overflow-auto">
        <thead class="thead-light">
        <tr>
            <th class="text-primary text-center align-middle">ردیف</th>
            <th class="text-primary text-center align-middle">عنوان نقش</th>
            <th class="text-primary text-center align-middle">مجوزها</th>
            <th class="text-primary text-center align-middle">ویرایش</th>
{{--            <th class="text-primary text-center align-middle">حذف</th>--}}
            <th class="text-primary text-center align-middle">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $index => $role)
            <tr>
                <td class="text-center align-middle">{{$roles->firstItem()+ $index}}</td>
                <td class="text-center align-middle">{{$role->name}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('create.role.permission',$role->id)}}">
                        مجوزها
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('roles.edit',$role->id)}}">
                        ویرایش
                    </a>
                </td>
{{--                <td class="text-center align-middle">--}}
{{--                    <a class="btn btn-outline-danger" wire:click="deleteRole({{$role->id}})">--}}
{{--                        حذف--}}
{{--                    </a>--}}
{{--                </td>--}}
                <td class="text-center align-middle ">{{\Hekmatinasser\Verta\Verta::instance($role->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$roles->appends(Request::except('page'))->links()}}
    </div>
</div>
