<?php

namespace Muan\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Muan\Admin\Facades\Properties;

/**
 * Class CreatePropertyRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class CreatePropertyRequest extends FormRequest
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
            'group_id' => 'required|integer',
            'slug' => 'required|min:3|max:225|unique:properties',
            'title' => 'required|min:3|max:225',
            'description' => 'max:225',
            'type' => 'required|in:' . implode(',', (array_keys(Properties::getTypes()))),
            'value' => 'max:225',
        ];
    }

}
