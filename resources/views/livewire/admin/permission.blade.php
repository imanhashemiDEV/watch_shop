<div class="table-responsive overflow-auto" tabindex="8">
    <table class="table table-striped table-hover overflow-auto">
        <thead class="thead-light">
        <tr>
            <th class="text-primary text-center align-middle">ردیف</th>
            <th class="text-primary text-center align-middle">عنوان مجوز</th>
            <th class="text-primary text-center align-middle">ویرایش</th>
{{--            <th class="text-primary text-center align-middle">حذف</th>--}}
            <th class="text-primary text-center align-middle">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $index => $permission)
            <tr>
                <td class="text-center align-middle">{{$permissions->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$permission->name}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('permissions.edit',$permission->id)}}">
                        ویرایش
                    </a>
                </td>
{{--                <td class="text-center align-middle">--}}
{{--                    <a class="btn btn-outline-danger" wire:click="deleteSlider({{$slider->id}})">--}}
{{--                        حذف--}}
{{--                    </a>--}}
{{--                </td>--}}
                <td class="text-center align-middle ">{{\Hekmatinasser\Verta\Verta::instance($permission->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$permissions->appends(Request::except('page'))->links()}}
    </div>
</div>
