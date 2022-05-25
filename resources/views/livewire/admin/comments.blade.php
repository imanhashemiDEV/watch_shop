<div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">متن نظر</th>
            <th class="text-center align-middle text-primary">نام نظر دهنده</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
            <th class="text-center align-middle text-primary">وضعیت</th>
            <th class="text-center align-middle text-primary">حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $index => $comment)
            <tr>
                <td class="text-center align-middle">{{$comments->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$comment->body}}</td>
                <td class="text-center align-middle">{{$comment->user->name}}</td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('%B %d، %Y')}}</td>
                <td class="text-center align-middle" wire:click="changeStatus({{ $comment->id }})">
                    @if ($comment->status =='accepted')
                            <span class="cursor-pointer badge badge-success">تایید</span>
                        @elseif ($comment->status =='rejected')
                            <span
                                class="cursor-pointer badge badge-danger">عدم تایید</span>
                        @else
                                <span
                                class="cursor-pointer badge badge-info">بررسی اولیه </span>
                        @endif
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click="deleteComment({{$comment->id}})">
                         حذف
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$comments->appends(Request::except('page'))->links()}}
    </div>
</div>
