<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->name),
        ]);
        if ($post = $this->route('post')) {
            $this->id = $post->id;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'slug' => 'required|unique:posts' . ($this->id ? ',slug,' . $this->id : ''),
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
