<?php

namespace App\Http\Requests\image;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'string|max:50',
            'image' => 'image|mimes:jpg,jpeg,png|max:10048'
        ];
    }
    
    public function messages()
    {
        return [
            'title.max' => 'タイトルは50文字以内にしてください。',
            'image.image' => '指定されたファイルが画像ではありません。',
            'image.mines' => '指定された拡張子(jpg/jpeg/png)ではありません。',
            'image.max' => 'ファイルサイズは10MB以内にしてください。',
        ];
    }
}
