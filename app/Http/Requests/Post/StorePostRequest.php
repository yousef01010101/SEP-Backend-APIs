<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [

            'title.string' => 'عنوان المنشور يجب أن يكون نصاً.',
            'title.max' => 'عنوان المنشور يجب ألا يتجاوز 255 حرفاً.',

            'content.required' => 'يجب إدخال محتوى للمنشور .',
            'content.string' => ' يجب أن يكون محتوى المنشور نصياً.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'فشل التحقق من صحة البيانات.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
