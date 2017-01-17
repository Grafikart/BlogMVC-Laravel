<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // Slug is "slugified" on every request
        if (empty($this->input('slug'))) {
            $this['slug'] = str_slug($this->input('name'));
        } else {
            $this['slug'] = str_slug($this->input('slug'));
        }
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ];
        if ($post = $this->route('post')) {
            $rules['slug'] .= ',slug,' . $post->id;
        }
        return $rules;
    }
}
