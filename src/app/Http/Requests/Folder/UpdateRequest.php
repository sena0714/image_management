<?php

namespace App\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        $folder = $this->route()->parameter('folder');
        return Gate::authorize('folder.update', $folder);
    }

    public function rules()
    {
        return [
            'name' => 'string|required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'フォルダ名は50文字以内にしてください。'
        ];
    }
}
