<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name'      => 'required|string|max:32',
            'user_name' => 'required|string|max:32',
            'mobile'    => 'nullable',
            'phone'     => 'nullable|string',
            'password'  => 'nullable|string|min:3|max:16|confirmed',
            'photo'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
