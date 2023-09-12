<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        // 等号= 即
        // key指向value
        return [
            'cover_image'        => ['required', 'mimes:png,jpg,gif,svg', 'max:2048'],
            'title'              => ['required', 'max:200', 'min:5'],
            // 'slug'              => ['required', 'max:200',],
            'body'              => ['required', 'min:5',],
            'meta_description'  => ['required', 'min:5', 'max:200',],
            'published_at'      => ['required', ''],
            // 'author_id'          => ['required',],
            'category_id'        => ['required', 'numeric'],
            'tags'               => ['required'],

        ];
    }
}
