<?php

namespace Muan\Admin\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TagResource
 *
 * @package Muan\Admin\Http\Resources
 */
class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->id,
            'title' => $this->title,
        ];
    }
}
