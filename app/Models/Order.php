<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'total_price',
        'status',
        'address_id',
        'transaction_id',
        'user_id',
        'code'
    ];

    public function orderDetails()
    {
       return $this->hasMany(OrderDetail::class);
    }

    public function recievedOrderDetails()
    {
        return $this->hasMany(OrderDetail::class)->where('status',OrderStatus::Received);
    }

    public function cancelledOrderDetails()
    {
        return $this->hasMany(OrderDetail::class)->where('status',OrderStatus::Cancelled);
    }

    public function processingOrderDetails()
    {
        return $this->hasMany(OrderDetail::class)->where('status',OrderStatus::Processing);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
