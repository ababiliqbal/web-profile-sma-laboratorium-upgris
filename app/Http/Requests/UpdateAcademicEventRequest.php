<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAcademicEventRequest extends FormRequest
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
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            // Perbaikan: Menambahkan 'holiday' sesuai skema database
            'category'    => ['required', Rule::in(['academic', 'ppdb', 'event', 'holiday'])],
            'documents'   => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,png,zip|max:5120', // Maks 5MB per file
        ];
    }
}
