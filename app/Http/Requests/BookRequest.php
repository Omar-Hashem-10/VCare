<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'phone'     => 'required|string|digits:11',
            'email'     => 'required|email',
            'time'      => 'required|date_format:Y-m-d H:i',
            'doctor_id' => 'required|exists:doctors,id',
            'user_id'   => 'required|exists:users,id',
            'status'    => 'required|in:pinned,Booked,examined',
        ];
    }

}