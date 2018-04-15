<?php

namespace Muan\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateGroupRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class CreateGroupRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|min:3|max:225|unique:groups',
            'title' => 'required|min:3|max:225',
            'description' => 'max:225',
        ];
    }

}
