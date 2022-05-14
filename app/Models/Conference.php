<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'about',
        'field',
        'status',
        'organizer',
        'image',
        'holding_date',
        'accept_article_date',
        'registration_deadline_date',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function conf_status($status)
    {
        switch ($status) {
            case 0:
                return "در حال ثبت نام";
                break;
            case 1:
                return "در حال پذیرش مقاله";
                break;
            case 2:
                return "در حال اجرا";
                break;
            case 3:
                return "اتمام همایش";
                break;
            default:
                return "نامشخص";
                break;
        }
    }
}
