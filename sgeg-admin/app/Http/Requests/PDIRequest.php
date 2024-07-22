<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PDIRequest extends FormRequest
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
            // Se añaden las validaciones
                'degree_color' => 'required|max:25|min:3',
                //'email' => 'required|email|max:250|min:3',
                'thesis_date' => 'required'
        ];
    }
}
 