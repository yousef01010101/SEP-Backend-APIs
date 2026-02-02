<?php

namespace App\Http\Requests\Topic;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTopicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [

            'name' => 'required|string|max:255|',
            'description' => 'string|nullable|max:1000',
        ];
    }

    public function messages(): array
    {
        return [

          'description.required_without' => 'يجب ادخال وصف الموضوع اذا لم يتم ادخال الاسم',
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
