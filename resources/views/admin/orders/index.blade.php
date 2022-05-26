@extends('admin.layouts.master')
@include('admin.partials.header',[$title='فروش ها'])
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
           <livewire:admin.orders/>
        </div>
    </div>
</main>
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteOrder', event => {
            Swal.fire({
                title: 'حذف فروش',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyOrder',event.detail.id);

                    Swal.fire(
                        'فروش حذف شد',
                        'فروش مورد نظر با موفقیت حذف شد',
                        'باشه'
                    );

                }
            });
        })
    </script>
@endsection
