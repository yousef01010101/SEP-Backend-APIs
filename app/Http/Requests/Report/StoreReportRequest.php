<?php

namespace App\Http\Requests\Report;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {

        return true;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required|integer|exists:posts,id',
            'type' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'يجب ادخال معرف المستخدم',
            'post_id.required' => 'يجب ادخال معرف المنشور',
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
