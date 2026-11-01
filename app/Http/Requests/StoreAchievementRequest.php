<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAchievementRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'level'       => ['required', Rule::in(['school', 'city', 'province', 'national', 'international'])],
            'type'        => ['required', Rule::in(['school', 'student'])],
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt'   => 'nullable|string|max:255',
        ];
    }
}
