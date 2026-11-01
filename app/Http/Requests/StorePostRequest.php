<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255|unique:posts,title',
            'category_id'      => 'required|exists:categories,id',
            'content'          => 'required|string',
            'status'           => 'required|in:published,draft',
            'tags'             => 'nullable|array',
            'tags.*'           => 'exists:tags,id', // Memastikan setiap tag ID valid
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt'        => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ];
    }
}
