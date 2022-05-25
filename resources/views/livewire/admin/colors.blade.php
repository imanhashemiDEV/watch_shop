<div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">عنوان رنگ</th>
            <th class="text-center align-middle text-primary">کد رنگ</th>
            <th class="text-center align-middle text-primary"> رنگ</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($colors as $index => $color)
            <tr>
                <td class="text-center align-middle">{{$colors->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$color->title}}</td>
                <td class="text-center align-middle">{{$color->code}}</td>
                <td class="text-center align-middle" style="background-color:{{ $color->code  }};  width:80px;">

                </td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($color->created_at)->format('%B %d، %Y')}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('colors.edit',$color->id)}}">
                         ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" onclick="deleteItem({{$color->id}})">
                         حذف
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$colors->appends(Request::except('page'))->links()}}
    </div>
</div>
