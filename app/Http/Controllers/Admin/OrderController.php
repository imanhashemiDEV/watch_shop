<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function orders(){



        return view('admin.orders.index');
    }

    public function orderDetails($order_id){

        $orderDetails = OrderDetail::query()->where('order_id',$order_id)->get();
        $total =0;
        foreach($orderDetails as $order){
          $total += $order->discount_price * $order->count;
        }
        return view('admin.orders.details', compact('orderDetails','total'));
    }
}
