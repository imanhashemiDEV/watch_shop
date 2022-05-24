<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'discount_price'=>($this->price - ((($this->price) * ($this->discount)) / 100)),
            'product_count'=>$this->product_count,
            'category'=>$this->category->title,
            'brand'=>$this->brand->title,
            'image'=> url('images/product/small/'.$this->image),
        ];
    }
}
