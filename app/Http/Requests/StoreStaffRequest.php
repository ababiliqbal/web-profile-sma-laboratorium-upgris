<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStaffRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'position'          => 'required|string|max:100',
            'type'              => ['required', Rule::in(['teacher', 'staff'])], // Sesuai skema
            'employment_status' => ['required', Rule::in(['pns', 'pppk', 'tetap_yayasan', 'honorer'])], // Sesuai skema
            'identity_number'   => 'nullable|string|max:50|unique:staffs,identity_number',
            'email'             => 'nullable|email|max:255|unique:staffs,email',
            'biography'         => 'nullable|string',
            'display_order'     => 'nullable|integer',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt'         => 'nullable|string|max:255',
            'subjects'          => 'nullable|array', // Untuk relasi mata pelajaran
            'subjects.*'        => 'exists:subjects,id',
        ];
    }
}
