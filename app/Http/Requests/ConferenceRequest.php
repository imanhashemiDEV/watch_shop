<?php

namespace App\Http\Requests;

use App\Helpers\DateShamsi;
use Illuminate\Foundation\Http\FormRequest;

class ConferenceRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'about'=>'required',
            'field'=>'required',
            'organizer'=>'required',
            'image'=> 'required',
            'holding_date'=> 'required',
            'accept_article_date'=>'required',
            'registration_deadline_date'=>'required',
        ];
    }
}
