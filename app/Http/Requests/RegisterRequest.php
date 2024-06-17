<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/', // Min 1 capital lether
                'regex:/[0-9]/', // Min 1 number
                'regex:/[@$!%*?&#]/', // Min 1 special char
                'max:255'
            ],
        ];
    }

    /**
     * Define custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name cannot be longer than 255 characters.',
            
            'email.required' => 'Email is required.',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email cannot be longer than 255 characters.',
            'email.unique' => 'Email is already taken.',
            
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.',
            'password.max' => 'Password cannot be longer than 255 characters.',
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        abort(418, $validator->errors());
    }

    /**
     * Setovanje neobaveznih polja na null ako nisu poslata
     * @return void
     */
    // public function prepareForValidation(): void
    // {
    //     if (!array_key_exists('name', $this->all())) {
    //         $this->merge(['name' => 'ssssss']);
    //     }      
    // }
}
