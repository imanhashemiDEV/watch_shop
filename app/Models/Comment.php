<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'body',
        'status',
        'user_id',
        'parent_id'
    ];

    public function commentable(){
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function comment_status($status)
    {
        switch ($status) {
            case CommentStatus::Accepted:
                return "تایید شده";
                break;
            case CommentStatus::Rejected:
                return "تایید نشده ";
                break;
            case CommentStatus::Draft:
                return "بررسی اولیه";
                break;
            default:
                return "نامشخص";
                break;
        }
    }
}
