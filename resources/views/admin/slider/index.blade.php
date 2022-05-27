@extends('admin.layouts.master')
@include('admin.partials.header',[$title='اسلاید ها'])
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
                <livewire:admin.sliders/>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        window.addEventListener('deleteSlider', event => {
            Swal.fire({
                title: 'حذف اسلایدر',
                text: "آیا از حذف مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('destroySlider',event.detail.id);

                    Swal.fire(
                        'اسلایدر حذف شد',
                        'اسلایدر مورد نظر با موفقیت حذف شد',
                    );

                }
            });
        })
    </script>
@endsection
