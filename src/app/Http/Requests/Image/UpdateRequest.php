<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Image;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        $image = $this->route()->parameter('image');
        return Gate::authorize('image.update', $image);
    }

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
