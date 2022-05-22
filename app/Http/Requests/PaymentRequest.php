<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'orders'=>'required|array',
            'orders.*.product_id'=>'required',
            'orders.*.count'=>'required',
        ];
    }

    public function messages(){
        return [
            'orders.required'=>'ارسال لیست خرید الزامی است',
            'orders.array'=>'خرید باید به صورت لیست باشد',
            'orders.*.product_id.required'=>'آیدی محصول الزامی است',
            'orders.*.count.required'=>'تعداد محصول الزامی است',
        ];

    }
}
