<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name'                          => 'required|string|min:3|max:50',
            'email'                         => 'required|email',
            'phone'                         => 'required|numeric|digits:11',
            'image'                         => 'required|image|max:2048',
            'bio'                           => 'required|string',
            'experience_years'              => 'required|numeric',
            'examination_price'              => 'required|numeric',
            'major_id'                      => 'required|numeric',
            'user_id'                       => 'required|numeric'
        ];
    }
}
