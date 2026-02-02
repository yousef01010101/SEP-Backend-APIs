<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'يجب تحديد المستخدم الذي أضاف المنشور.',
            'user_id.exists' => 'المستخدم المحدد غير موجود في النظام.',

            'title.max' => 'عنوان المنشور يجب ألا يتجاوز 255 حرفاً.',
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
