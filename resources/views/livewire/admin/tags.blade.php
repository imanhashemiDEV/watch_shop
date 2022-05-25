<div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">عنوان تگ</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $index => $tag)
            <tr>
                <td class="text-center align-middle">{{$tags->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$tag->title}}</td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($tag->created_at)->format('%B %d، %Y')}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('tags.edit',$tag->id)}}">
                         ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" onclick="deleteItem({{$tag->id}})">
                         حذف
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$tags->appends(Request::except('page'))->links()}}
    </div>
</div>
