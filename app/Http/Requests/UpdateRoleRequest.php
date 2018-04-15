<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class UpdateRoleRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdateRoleRequest extends CreateRoleRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255|unique:roles,name,' . $this->id,
        ];
    }

}
