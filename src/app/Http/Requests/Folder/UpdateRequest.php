<?php

namespace App\Http\Requests\Folder;

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
            'folder_name' => 'string|required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'folder_name.max' => 'フォルダ名は50文字以内にしてください。'
        ];
    }
}
