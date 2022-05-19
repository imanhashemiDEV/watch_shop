<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'title'=>'required',
            'price'=>'required|numeric',
            'product_count'=>'required|numeric',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'required|exists:brands,id',
        ];
    }
}
