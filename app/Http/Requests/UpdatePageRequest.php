<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
                // Aturan ini akan mengabaikan ID halaman saat ini ($this->page) saat memeriksa keunikan
                Rule::unique('pages')->ignore($this->page->id),
            ],
            'content'          => 'nullable|string',
            'status'           => 'required|in:published,draft',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            // --- TAMBAHKAN VALIDASI INI ---
            'image_alt'        => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'documents'   => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,png,zip|max:5120', // Maks 5MB per file
        ];
    }
}
