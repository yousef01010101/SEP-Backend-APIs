<?php

namespace App\Http\Requests\Video;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VideoRequest extends FormRequest
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
            'video' => 'required|file|mimetypes:video/*|mimes:mp4,mov,avi,mkv,wmv,flv|max:102400',
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'حقل معرف المنشور مطلوب.',
            'post_id.exists' => 'معرف المنشور غير صالح.',
            'video.required' => 'حقل الفيديو مطلوب.',
            'video.file' => 'يجب أن يكون الملف المرفوع فيديو صالح.',
            'video.mimetypes' => 'يجب أن يكون نوع ملف الفيديو صالحًا.',
            'video.mimes' => 'يجب أن يكون امتداد ملف الفيديو من الأنواع التالية: mp4, mov, avi, mkv, wmv, flv.',
            'video.max' => 'يجب ألا يتجاوز حجم ملف الفيديو 100 ميجابايت.',
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
