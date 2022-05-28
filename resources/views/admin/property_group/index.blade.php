@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست گروه بندی'])
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

        <div class="card">
            <div class="card-body">
               <livewire:admin.property-groups/>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>
        window.addEventListener('deletePropertyGroup', event => {
            Swal.fire({
                title: 'حذف گروه بندی',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroyPropertyGroup',event.detail.id);

                    Swal.fire(
                        'گروه بندی حذف شد',
                        'گروه بندی مورد نظر با موفقیت حذف شد',
                    );

                }
            });
        })
    </script>
@endsection
