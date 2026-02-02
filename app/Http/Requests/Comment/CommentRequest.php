<?php

namespace App\Http\Requests\Comment;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class CommentRequest extends FormRequest
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
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'يجب تحديد المنشور .',
            'post_id.exists' => 'المنشور المحدد غير موجود في النظام.',

            'content.required' => 'يجب إدخال محتوى للتعليق .',
            'content.string' => ' يجب أن يكون محتوى التعليق نصياً.',
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
