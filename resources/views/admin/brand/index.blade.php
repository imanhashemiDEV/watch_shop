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

