<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class UpdateUserRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdateUserRequest extends CreateUserRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id,
            'password' => 'confirmed',
            'sex' => 'in:unknown,male,female',
        ];
    }

}
