<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title_fa' => ['required', 'string', 'min:1', 'max:255', 'regex:/^[آ-یء\s]+$/u'],
            'title_en' => ['nullable', 'string', 'min:1', 'max:255','regex:/^[a-zA-Z]+$/u'],
            'price' => ['required', 'numeric', 'min:0', 'max:16777216'],
            'count' => ['required', 'numeric', 'min:0', 'max:16777216'],
            'photo' => ['required'],
            'guaranty' => ['nullable', 'string', 'min:1', 'max:255'],
            'discount' => ['nullable', 'numeric', 'min:1', 'max:16777216'],
            'description' => ['nullable', 'string', 'min:1'],
            'is_special' => ['nullable', 'boolean'],
            'special_expiration' => ['nullable', 'date', 'after_or_equal:1970-01-01 00:00:01', 'before_or_equal:2038-01-19 03:14:07'],
            'category_id' => ['nullable', 'numeric'],
            'brand_id' => ['nullable', 'numeric'],
        ];
    }
}
