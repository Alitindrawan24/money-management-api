<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            "category_id" => "required|exists:categories,id",
            "date" => "required|date|date_format:Y-m-d",
            "amount" => "required|numeric|min:0,max:999999999",
            "description" => "required|string|max:255",
            "tag_ids" => "nullable|array",
            "tag_ids.*" => "numeric|exists:tags,id",
        ];
    }
}
