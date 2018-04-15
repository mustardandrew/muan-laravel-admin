<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class UpdateGroupRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdateGroupRequest extends CreateGroupRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|min:3|max:225|unique:groups,slug,' . $this->id,
            'title' => 'required|min:3|max:225',
            'description' => 'max:225',
        ];
    }

}
