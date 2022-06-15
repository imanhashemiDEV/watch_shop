<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $products = Product::query()->count();
        $orders = Order::query()->where('status', 'success')->count();
        $comments = Comment::query()->count();
        $users = User::query()->count();

        return view('admin.index', compact('users', 'products', 'comments', 'orders'));
    }
}
