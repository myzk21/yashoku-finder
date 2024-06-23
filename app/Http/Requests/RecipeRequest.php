<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|max:50',
            'ingredients.*.quantity' => 'required|string|max:50',
            'steps' => 'required|array',
            'steps.*' => 'required|string|max:50',
            'categories' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title' => 'レシピ名は必須です',
            'description' => 'レシピの説明は必須です',
            'image' => 'レシピの画像',
            'ingredients' => '材料は必須です',
            'ingredients.*.name' => '材料名は必須です',
            'ingredients.*.quantity' => '分量は必須です',
            'steps' => '手順は必須です',
            'steps.*' => '手順は必須です',
            'categories' => 'カテゴリーは必須です',
        ];
    }
}
