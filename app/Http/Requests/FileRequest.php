<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
        if ($this->_method == 'PUT') {
            $file = 'nullable|file|mimes:pdf|max:20500'; // 20MB
        } else {
            $file = 'required|file|mimes:pdf|max:20500'; // 20MB
        }

        return [
            'file' => $file,
            'name' => 'nullable|string|max:255',
        ];
    }
}
