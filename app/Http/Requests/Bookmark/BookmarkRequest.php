<?php

namespace App\Http\Requests\Bookmark;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookmarkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'post_id' => 'required|exists:posts,id',
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'يجب تحديد المنشور.',
            'post_id.exists' => 'المشور المحدد غير موجود في النظام.',
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
