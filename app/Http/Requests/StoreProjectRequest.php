<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url',
            'github_link' => 'nullable|url',
            'cover_image' => 'nullable|image|max:2048', // Max 2MB
            'gallery_images.*' => 'image|max:2048', // Max 2MB per image
            'technologies' => 'nullable|string',
            'status' => 'required|in:draft,in_progress,completed',
        ];
    }
}
