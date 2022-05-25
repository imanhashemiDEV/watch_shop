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
                <div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">نام محصول</th>
                            <th class="text-center align-middle text-primary"> قیمت بدون تخفیف </th>
                            <th class="text-center align-middle text-primary"> قیمت با تخفیف</th>
                            <th class="text-center align-middle text-primary"> تعداد</th>
                            <th class="text-center align-middle text-primary"> وضعیت تحویل</th>
                            <th class="text-center align-middle text-primary">تاریخ تراکنش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderDetails as $index => $order)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1}}</td>
                                <td class="text-center align-middle">{{$order->product->title}}</td>
                                <td class="text-center align-middle">{{number_format($order->price)}} تومان</td>
                                <td class="text-center align-middle">{{number_format($order->discount_price)}} تومان</td>
                                <td class="text-center align-middle">{{$order->count}}</td>
                                <td class="text-center align-middle">
                                    @if ($order->status =='cancelled')
                                    <span class="cursor-pointer badge badge-danger">مرجوع شده</span>
                                    @elseif ($order->status =='recieved')
                                    <span class="cursor-pointer badge badge-success">تحویل شده</span>
                                    @else
                                    <span class="cursor-pointer badge badge-info">در حال پردازش</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($order->created_at)->format('%B %d، %Y')}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-center align-middle "> جمع کل خرید</td>
                            <td colspan="5" class="text-center align-middle"> {{number_format($total)}} تومان</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

