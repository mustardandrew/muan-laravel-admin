<?php

namespace Muan\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreatePageRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class CreatePageRequest extends FormRequest
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
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        if (! $this->input('slug')) {
            $this->merge(['slug' => str_slug($this->input('title', ''))]);
        }

        $this->merge([
            'user_id' => auth()->id(),
            'is_active' => $this->input('is_active', 0),
        ]);

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
            'slug' => 'required|min:3|max:255|unique:pages',
            'title' => 'required|min:3|max:255',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
            'meta_keywords' => 'max:255',
            'meta_robots' => 'max:255',
            'is_active' => 'boolean',
        ];
    }

}
