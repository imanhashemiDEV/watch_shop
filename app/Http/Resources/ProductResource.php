<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'title_en'=>$this->title_en,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'guaranty'=>$this->guaranty,
            'product_count'=>$this->product_count,
            'review'=>$this->review,
            'image'=> url('images/product/small/'.$this->image)
        ];
    }
}
