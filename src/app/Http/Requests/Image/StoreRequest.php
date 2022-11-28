<?php

namespace App\Http\Requests\Image;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10480'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須項目です。',
            'title.max' => 'タイトルは50文字以内にしてください。',
            'image.required' => '画像は必須項目です。',
            'image.image' => '指定されたファイルが画像ではありません。',
            'image.mines' => '指定された拡張子(jpg/jpeg/png)ではありません。',
            'image.max' => 'ファイルサイズは10MB以内にしてください。',
        ];
    }

    public function makeImage(): Image
    {
        return new Image($this->validated());
    }
}
