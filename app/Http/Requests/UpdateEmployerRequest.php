<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateEmployerRequest extends FormRequest
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
            'name' => 'max:50|min:3',
            'email'=>[Rule::unique('users')->ignore($this->user()->id, 'id')
            ,'email',
            'max:50'],
            'industry' => 'max:50',
            'password' => 'max:16|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-={}[\]:;"\'<>,.?\/]).{8,}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'name.max'=>'maximum length for name is 50 letters',
            'name.min' => 'name must be at least 3 characters long',
            'email.unique' => 'this email is already exists',
            'email.regex' => 'invalid email',
            'password.max' => 'Password cannot be longer than 16 characters',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character',
            'industry.max'=>'maximum length for industry is 50 letters',
        ];
    }
}
