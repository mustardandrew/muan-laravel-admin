<?php

namespace Muan\Admin\Http\Requests;

/**
 * Class CreateCategoryRequest
 *
 * @package Muan\Admin\Http\Requests
 */
class UpdateCategoryRequest extends CreateCategoryRequest
{

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

        $this->merge(['is_active' => $this->input('is_active', 0),]);

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
            'slug' => 'required|min:3|max:255|unique:categories,slug,'  . $this->id,
            'parent_category_id' => 'required|not_in:' . $this->id,
            'title' => 'required|min:3|max:255',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
            'meta_keywords' => 'max:255',
            'meta_robots' => 'max:255',
            'is_active' => 'boolean',
        ];
    }

}
