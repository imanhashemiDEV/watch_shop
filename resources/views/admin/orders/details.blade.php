@extends('admin.layouts.master')
@include('admin.partials.header',[$title='جزئیات فروش ها'])
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
                <livewire:admin.order-detail :order_id="$order_id"/>
            </div>
        </div>
    </main>
@endsection

