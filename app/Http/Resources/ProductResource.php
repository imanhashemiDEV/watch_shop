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
            'id'=>$this->id,
            'title'=>$this->title,
            'title_en'=>$this->title_en,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'discount_price'=>($this->price - ((($this->price) * ($this->discount)) / 100)),
            'guaranty'=>$this->guaranty,
            'product_count'=>$this->product_count,
            'category'=>$this->category->title,
            'category_id'=>$this->category_id,
            'colors'=> ColorResource::collection($this->colors),
            'brand'=>$this->brand->title,
            'brand_id'=>$this->brand_id,
            'review'=>$this->review,
            'image'=> url('images/product/small/'.$this->image),
            'properties'=> PropertyResource::collection($this->properties),
            'description'=>$this->description,
            'discussion'=>$this->discussion,
            'comments'=> CommentResource::collection($this->comments),
        ];
    }
}
