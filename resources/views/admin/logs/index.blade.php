@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لاگ های سیستم'])
@section('content')
    <!-- begin::main content -->
    <main class="main-content">
        <div class="card">
            <div class="card-body">
                    <iframe style="border-width: 0" width="100%" height="1000px" src="{{ route('log-viewer::dashboard') }}"></iframe>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection

