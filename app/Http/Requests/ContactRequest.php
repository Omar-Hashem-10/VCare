<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'      => 'required|string|min:3|max:50',
            'phone'     => 'nullable|string|digits:11',
            'email'     => 'required|email',
            'subject'   => 'required|in:general_inquiry,technical_support,feedback,other',
            'message'   => 'required|string',
        ];
    }

}
