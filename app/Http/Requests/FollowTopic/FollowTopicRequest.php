<?php

namespace App\Http\Requests\FollowTopic;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FollowTopicRequest extends FormRequest
{
    public function authorize(): bool
    {

        return true;
    }

    public function rules(): array
    {
        return [

            'topic_id' => 'required|integer|exists:topics,id',
        ];
    }

    public function messages(): array
    {
        return [
            'topic_id.required' => 'يجب ادخال معرف الموضوع',
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
