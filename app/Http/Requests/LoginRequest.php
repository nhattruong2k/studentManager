<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' =>'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_email'),
            'password.required' => __('auth.password_required'),
        ];   
    }
}
