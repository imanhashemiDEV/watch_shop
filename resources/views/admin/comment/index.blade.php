@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست نظرات'])
@section('content')
    <!-- begin::main content -->
    <main class="main-content">

        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        </div>
        <?php $i=(isset($_GET['page']))  ? (($_GET['page']-1)*20)+1 : 1; ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-primary text-center align-middle">ردیف</th>
                            <th class="text-primary text-center align-middle">متن نظر</th>
                            <th class="text-primary text-center align-middle">نام نظر دهنده</th>
                            <th class="text-primary text-center align-middle">تاریخ ایجاد</th>
                            <th class="text-primary text-center align-middle">تایید یا عدم تایید</th>
                            <th class="text-primary text-center align-middle">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>
                                <td class="text-center align-middle">{{$comment->body}}</td>
                                <td class="text-center align-middle">{{$comment->user->name}}</td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle d-flex align-items-center justify-content-center">
                                    <form action="{{route('comment.update', $comment->id)}}" method="post" style="margin: 0 !important;">
                                        @csrf
                                        @method('patch')
                                        @if($comment->status ==0)
                                            <input type="hidden" name="action" value="approved">
                                            <button class="btn btn-outline-danger"> تایید</button>
                                        @else
                                            <input type="hidden" name="action" value="disapproved">
                                            <button class="btn btn-outline-success"> عدم تایید</button>
                                        @endif
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-danger" onclick="deleteItem({{$comment->id}})">
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
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف نظر',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax(
                        {
                            url: url + "/admin/comments/"+id,
                            type: 'delete',
                            dataType: "JSON",
                            data: {
                                _token:"{{csrf_token()}}",
                                "id": id
                            },
                            success: function (response)
                            {
                                Swal.fire(
                                    'نظر حذف شد',
                                    'نظر مورد نظر با موفقیت حذف شد',
                                    'باشه'
                                );
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });

                    location.reload();
                }
            });
        }
    </script>
@endsection
