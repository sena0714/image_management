<?php

namespace App\Http\Requests\image;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須項目です。',
            'max' => 'タイトルは50文字以内にしてください。',
            'image.required' => '画像は必須項目です。',
            'image.image' => '指定されたファイルが画像ではありません。',
            'image.mines' => '指定された拡張子(jpg/jpeg/png)ではありません。',
            'image.max' => 'ファイルサイズは2MB以内にしてください。',
        ];
    }
}
