<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'school_name'        => 'required|string|max:255',
            'school_address'     => 'nullable|string',
            'school_phone'       => 'nullable|string|max:20',
            'school_email'       => 'nullable|email|max:255',
            'school_vision'      => 'nullable|string', // Contoh jika ada Visi
            'school_mission'     => 'nullable|string', // Contoh jika ada Misi
            'gmaps_url'          => 'nullable|string',
            'facebook_url'       => 'nullable|url',
            'twitter_url'        => 'nullable|url',
            'instagram_url'      => 'nullable|url',
            'youtube_url'        => 'nullable|url',
            'school_logo'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024', // Untuk upload logo
            'school_favicon'     => 'nullable|image|mimes:ico,png|max:512',      // Untuk upload favicon
        ];
    }
}
