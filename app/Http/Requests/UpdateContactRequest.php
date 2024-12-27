<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
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
                'email' => [
                    'required',
                    'email',
                    Rule::unique('contacts')->ignore($this->route('id')), // Exclude current record
                    ],
                'phone' => 'required|string|max:255',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is Required',
            'email.required' => 'Email field is Required',
            'phone.required' => 'Phone field is Required',
            'name.string' => 'Please enter valid name max lenght could be 15.',
            'email.email' => 'Please enter valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone.string' => 'Please valid phone number.',
        ];
    }
}
