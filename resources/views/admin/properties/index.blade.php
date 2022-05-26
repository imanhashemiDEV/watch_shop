@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست مشخصات محصول'])
@section('content')
    <main class="main-content">
        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">عنوان  مشخصات</th>
                            <th class="text-center align-middle text-primary">گروه مشخصات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($properties as $index => $property)
                            <tr>
                                <td class="text-center align-middle">{{$properties->firstItem() + $index  }}</td>
                                <td class="text-center align-middle">{{$property->title}}</td>
                                <td class="text-center align-middle">{{$property->property_groups->title}}</td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($property->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('properties.edit',$property->id)}}">
                                         ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="post" >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger">
                                            حذف
                                       </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$properties->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteProperty', event => {
            Swal.fire({
                title: 'حذف مقاله',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyProperty',event.detail.id);

                    Swal.fire(
                        'ویژگی حذف شد',
                        'ویژگی مورد نظر با موفقیت حذف شد',
                        'باشه'
                    );

                }
            });
        })
    </script>
@endsection
