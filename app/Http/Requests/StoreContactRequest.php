<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is Required',
            'email.required' => 'Email field is Required',
            'phone.required' => 'Phone field is Required',
            'name.string' => 'Please enter a valid name. Max length is 15 characters.',
            'email.email' => 'Please enter a valid email address.',
            'phone.string' => 'Please enter a valid phone number.',
        ];
    }
}
