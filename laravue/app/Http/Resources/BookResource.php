<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'title' => $this->title,
            'author' => $this->author,
            'categories' => $this->categories->implode('category_name', ', '),
            'publishing_house' => $this->publishing_house,
            'publishing_date' => $this->publishing_date->format('m-d-Y')
        ];
    }
}
