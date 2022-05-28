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
               <livewire:admin.properties/>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteProperty', event => {
            Swal.fire({
                title: 'حذف ویژگی',
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
