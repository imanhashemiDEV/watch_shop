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
        return view('admin.orders.details', compact('order_id'));
    }
}
