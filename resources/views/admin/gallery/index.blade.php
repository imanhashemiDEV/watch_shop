@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست عکس ها'])
<style>
    form {
        display: block;
        margin-top: 0;
        margin-block-end: 0;
    }
</style>
@section('content')
    <main class="main-content">
        <?php $i=(isset($_GET['page']))  ? (($_GET['page']-1)*20)+1 : 1; ?>
            @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">لینک</th>
                            <th class="text-center align-middle text-primary">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($galleries as $index => $gallery)
                            <tr>
                                <td class="text-center align-middle">{{$galleries->firstItem() + $index}}</td>
                                <td class="text-center align-middle rtl">{{url('images/gallery')."/" . $gallery->url}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-danger" onclick="deleteItem({{$gallery->id}})">
                                        حذف
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$galleries->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteGallery', event => {
            Swal.fire({
                title: 'حذف گالری',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyGallery',event.detail.id);

                    Swal.fire(
                        'گالری حذف شد',
                        'گالری مورد نظر با موفقیت حذف شد',
                        'باشه'
                    );

                }
            });
        })
    </script>
@endsection
