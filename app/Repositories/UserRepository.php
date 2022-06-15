<?php

namespace App\Repositories;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Resources\CancelledOrderResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProcessingOrderResource;
use App\Http\Resources\ReceivedOrderResource;
use App\Models\Order;

class UserRepository
{
    // received products
    public static function receivedUserOrder($user)
    {
        $orders = Order::query()->whereHas('orderDetails', function ($q) {
            return $q->where('status', OrderStatus::Received);
        })->where('user_id', $user->id)
            ->where('status', PaymentStatus::Success)->get();

        return ReceivedOrderResource::collection($orders);
    }

    public static function receivedUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails', function ($q) {
            return $q->where('status', OrderStatus::Received);
        })->where('user_id', $user->id)
            ->where('status', PaymentStatus::Success)->count();
    }

    //  cancelled products
    public static function cancelledUserOrder($user)
    {
        $orders = Order::query()->whereHas('orderDetails', function ($q) {
            return $q->where('status', OrderStatus::Cancelled);
        })->where('user_id', $user->id)
            ->where('status', PaymentStatus::Success)->get();

        return CancelledOrderResource::collection($orders);
    }

    public static function cancelledUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails', function ($q) {
            return $q->where('status', OrderStatus::Cancelled);
        })->where('user_id', $user->id)
            ->where('status', PaymentStatus::Success)->count();
    }

    // processing products
    public static function processingUserOrder($user)
    {
        $orders = Order::query()->whereHas('orderDetails', function ($q) {
            return $q->where('status', OrderStatus::Processing);
        })->where('user_id', $user->id)
            ->where('status', PaymentStatus::Success)->get();

        return ProcessingOrderResource::collection($orders);
    }

    public static function processingUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails', function ($q) {
            return $q->where('status', OrderStatus::Processing);
        })->where('user_id', $user->id)
            ->where('status', PaymentStatus::Success)->count();
    }
}
