<?php

namespace App\Http\Requests\Reply;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReplyRequest extends FormRequest
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
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'comment_id.required' => 'يجب تحديد التعليق الخاص بالرد',
            'comment_id.exists' => 'التعليق المحدد غير موجود في النظام.',

            'content.required' => 'يجب إدخال محتوى للرد .',
            'content.string' => ' يجب أن يكون محتوى الرد نصياً.',
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
