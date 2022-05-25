<div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">نام و نام خانوادگی</th>
            <th class="text-center align-middle text-primary">ایمیل</th>
            <th class="text-center align-middle text-primary">موبایل</th>
            <th class="text-center align-middle text-primary">نقش های کاربر</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $index => $user)
            <tr>
                <td class="text-center align-middle">{{$users->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$user->name}}</td>
                <td class="text-center align-middle">{{$user->email}}</td>
                <td class="text-center align-middle">{{$user->mobile}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('create.user.roles',$user->id)}}">
                        نقش های کاربر
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('users.edit',$user->id)}}">
                        ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$users->appends(Request::except('page'))->links()}}
    </div>
</div>
