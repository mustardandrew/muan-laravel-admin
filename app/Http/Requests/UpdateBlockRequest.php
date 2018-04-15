<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class UpdateBlockRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdateBlockRequest extends CreateRoleRequest
{

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $this->merge(['is_active' => $this->input('is_active', 0)]);

        return $this->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|min:3|max:255|unique:blocks,slug,' . $this->id,
            'title' => 'required|min:3|max:225',
            'description' => 'min:3|max:225',
            'is_active' => 'boolean'
        ];
    }

}
