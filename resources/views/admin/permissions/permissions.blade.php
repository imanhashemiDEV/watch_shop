@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست مجوزها'])
<style>
    form {
        display: block;
        margin-top: 0;
        margin-block-end: 0;
    }
</style>
@section('content')
    <!-- begin::main content -->
    <main class="main-content">
        <div class="row">
            @if(Session::has('category'))
                <div class="alert alert-info">
                    <div>{{session('category')}}</div>
                </div>
            @endif
        </div>
        <?php $i=(isset($_GET['page']))  ? (($_GET['page']-1)*20)+1 : 1; ?>
        <div class="card">
            <div class="card-body">
               <livewire:admin.permission/>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        window.addEventListener('deletePermission', event => {
            Swal.fire({
                title: 'حذف مجوز',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyPermission',event.detail.id);

                    Swal.fire(
                        'مجوز حذف شد',
                        'مجوز مورد نظر با موفقیت حذف شد',
                    );

                }
            });
        })
    </script>
@endsection
