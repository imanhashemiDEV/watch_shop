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
               <livewire:admin.tags/>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteTag', event => {
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

                    Livewire.emit('destroyTag',event.detail.id);

                    Swal.fire(
                        'تگ حذف شد',
                        'تگ مورد نظر با موفقیت حذف شد',
                    );

                }
            });
        })
    </script>
@endsection
