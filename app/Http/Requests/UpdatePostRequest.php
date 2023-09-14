<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cover_image'        => ['sometimes', 'mimes:png,jpg,gif,svg', 'max:2048'],
            'title'              => ['required', 'max:200', 'min:5'],
            'body'               => ['required', 'min:5',],
            'meta_description'   => ['required', 'min:5', 'max:200',],
            'published_at'       => ['required', ''],
            'category_id'        => ['required', 'numeric'],
            // 'tags'               => ['required'],

        ];
    }
}
