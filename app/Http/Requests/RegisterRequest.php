<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['candidate', 'examiner'])],
            // Make role-specific fields nullable by default if they are not always required.
            // This is crucial. If they are not for the current role, Laravel will ignore them.
    

        ];

        // Apply 'required' only if the specific role is selected
        if ($this->input('role') === 'candidate') {
            $rules['guardian_name'] = ['required', 'string', 'max:255'];
            $rules['guardian_phone'] = ['required', 'string'];
        } elseif ($this->input(key: 'role') === 'examiner') {
            $rules['institute_name'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Please enter your first name.',
            'lastname.required' => 'Please enter your last name.',
            'phone.required' => 'Please enter your phone number.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'role.required' => 'Please select a role.',
            'role.in' => 'The selected role is invalid.',
            'guardian_name.required' => 'Please enter your guardian\'s name.',
            'guardian_phone.required' => 'Please enter your guardian\'s phone number.',
            'institute_name.required' => 'Please enter your institute name.',
        ];
    }
}
