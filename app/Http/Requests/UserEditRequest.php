<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:255'],
            'email' => ['required', Rule::unique('users')->ignore($this->user_id), 'min:4', 'max:255'],
            'password' => ['required_if:checkBoxChangePassword,on', 'confirmed', 'min:8', 'max:255', 'nullable'],
        ];
    }

    public function messages()
    {
        return [
            'password.required_if' => 'O campo :attribute é obrigatório quando o campo :other for selecionado.',
        ];
    }
}
