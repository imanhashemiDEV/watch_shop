@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست تگ ها'])
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
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف تگ',
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
                            url: url + "/admin/tags/"+id,
                            type: 'delete',
                            dataType: "JSON",
                            data: {
                                _token:"{{csrf_token()}}",
                                "id": id
                            },
                            success: function (response)
                            {
                                Swal.fire(
                                    'تگ حذف شد',
                                    'تگ مورد نظر با موفقیت حذف شد',
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
