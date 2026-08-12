<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'title_fa' => $this->title_fa,
            'title_en' => $this->title_en,
            'price' => $this->price,
            'total_price' => $this->totalprice ?? null,
            'review' => $this->review,
            'count' => $this->count,
            'sold' => $this->sold,
            'photo' => url('admin/product/'.$this->photo),
            'guaranty' => $this->guaranty,
            'discount' => $this->discount,
            'description' => $this->description,
            'is_special' => $this->is_special,
            'special_expiration' => $this->special_expiration,
            'category_id' => $this->category_id,
            'category' => $this->category->title ?? null,
            'brand_id' => $this->brand_id,
            'brand' => $this->brand->title  ?? null,
            'discount_percent' => $this->discount_percent,
            'average_rate' => $this->average_rate,

            // یکمی پیچیده تره
            'comments' => CommentResource::collection($this->comments),
            'colors' => ColorResource::collection($this->colors),
        ];
    }
}
