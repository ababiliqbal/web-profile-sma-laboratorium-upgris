<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumniTestimonialRequest extends FormRequest
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
            'name'               => 'required|string|max:255',
            'graduation_year'    => 'nullable|string|digits:4|integer|min:1900',
            'testimonial'        => 'required|string',
            'current_occupation' => 'nullable|string|max:255',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt'          => 'nullable|string|max:255',
        ];
    }
}
