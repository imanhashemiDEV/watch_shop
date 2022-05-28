@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست  برندها'])
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
                <livewire:admin.brands/>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteBrand', event => {
            Swal.fire({
                title: 'حذف برند',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyBrand',event.detail.id);

                    Swal.fire(
                        'برند حذف شد',
                        'برند مورد نظر با موفقیت حذف شد',
                    );
                }
            });
        })
    </script>
@endsection
