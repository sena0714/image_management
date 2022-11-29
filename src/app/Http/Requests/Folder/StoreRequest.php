<?php

namespace App\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Folder;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'フォルダ名は50文字以内にしてください。'
        ];
    }

    public function makeFolder():Folder
    {
        return new Folder($this->validated());
    }
}
