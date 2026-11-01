<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExtracurricularRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('extracurriculars')->ignore($this->extracurricular->id),
            ],
            'description' => 'nullable|string',
            'schedule'    => 'nullable|string|max:255',
            'coach_staff_id' => 'nullable|exists:staffs,id',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt'   => 'nullable|string|max:255',
        ];
    }
}
