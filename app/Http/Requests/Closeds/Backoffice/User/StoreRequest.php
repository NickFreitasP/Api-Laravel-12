<?php

namespace App\Http\Requests\Closeds\Backoffice\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            "name" => "required|string|max:255",
            "email" => "required|email:unique|max:255",
            "password"=> "required|string|max:255"
        ];
    }
    public function messages(): array
   {
       return [
           'name.required' => 'A name is required',
           'email.required' => 'A email is required',
           'password.required' => 'A password is required',
       ];
   }


}
