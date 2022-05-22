<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders(){

        $orders = Order::query()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }
}
