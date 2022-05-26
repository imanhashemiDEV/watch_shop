@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست دسته بندی'])
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
                <livewire:admin.products/>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteCategory', event => {
            Swal.fire({
                title: 'حذف دسته بندی',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyCategory',event.detail.id);

                    Swal.fire(
                        'دسته بندی حذف شد',
                        'دسته بندی مورد نظر با موفقیت حذف شد',
                    );

                }
            });
        })
    </script>
@endsection
