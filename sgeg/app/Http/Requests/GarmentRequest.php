<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GarmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           // 'available' => 'required',
            'name' => 'required|max:150|min:3'
        ];
    }
}
