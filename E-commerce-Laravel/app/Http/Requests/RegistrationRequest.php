<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     // for us to authorize validation on request turn authorize to true
    public function authorize(): bool
    {
        return true; // here was false
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // set the rules which will apply validation     
            'username' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email:filter', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role_id' => ['required', 'integer']
        ];
    }
}
