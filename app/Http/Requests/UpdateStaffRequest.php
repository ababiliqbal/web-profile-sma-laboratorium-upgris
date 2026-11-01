<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStaffRequest extends FormRequest
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
        // $this->staff merujuk pada model Staff yang sedang di-update
        $staffId = $this->staff->id;

        return [
            'name'              => 'required|string|max:255',
            'position'          => 'required|string|max:100',
            'type'              => ['required', Rule::in(['teacher', 'staff'])],
            'employment_status' => ['required', Rule::in(['pns', 'pppk', 'tetap_yayasan', 'honorer'])],
            'identity_number'   => ['nullable', 'string', 'max:50', Rule::unique('staffs')->ignore($staffId)],
            'email'             => ['nullable', 'email', 'max:255', Rule::unique('staffs')->ignore($staffId)],
            'biography'         => 'nullable|string',
            'display_order'     => 'nullable|integer',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt'         => 'nullable|string|max:255',
            'subjects'          => 'nullable|array',
            'subjects.*'        => 'exists:subjects,id',
        ];
    }
}
