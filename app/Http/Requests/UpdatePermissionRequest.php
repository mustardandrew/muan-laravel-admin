<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class UpdatePermissionRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdatePermissionRequest extends CreatePermissionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255|unique:permissions,name,' . $this->id,
        ];
    }

}
