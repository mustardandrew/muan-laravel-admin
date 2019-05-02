<?php

namespace Muan\Admin\Http\Requests;
/**
 * Class UpdateTagRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdateTagRequest extends CreateTagRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|min:3|max:255|unique:tags,slug,' . $this->id,
            'title' => 'required|min:3|max:255',
        ];
    }

}
