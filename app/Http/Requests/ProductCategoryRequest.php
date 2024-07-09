<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        $method = strtolower($this->method());
        $generalRules = [
            'parent_id' => 'nullable|exists:product_categories,id',
            'name' => 'required',
        ];

        switch ($method) {
            case 'post':
                $rules = [
                    ...$generalRules,
                    'slug' => 'required|regex:/^[a-zA-Z0-9-]+$/|unique:product_categories',
                ];
                break;
            case 'patch':
                $productCategoryID = $this->route()->product_category->id;
                $rules = [
                    ...$generalRules,
                    'slug' => 'required|regex:/^[a-zA-Z0-9-]+$/|unique:product_categories,slug,' . $productCategoryID,
                ];
                break;
        }

        return $rules;
    }
}
