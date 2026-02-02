<?php

namespace App\Http\Requests\FollowUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FollowUserRequest extends FormRequest
{
    public function authorize(): bool
    {

        return true;
    }

    public function rules(): array
    {
        return [

            'following_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'following_id.required' => 'يجب ادخال معرف المستخدم الذي يراد متابعته',
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
