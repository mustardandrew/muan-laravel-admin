<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class UpdatePropertyRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdatePropertyRequest extends CreatePropertyRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id' => 'required|integer',
            'slug' => 'required|min:3|max:225|unique:properties,slug,' . $this->id,
            'title' => 'required|min:3|max:225',
            'description' => 'max:225',
            'type' => 'required|in:' . implode(',', (array_keys(Properties::getTypes()))),
            'value' => 'max:225',
        ];
    }

}
