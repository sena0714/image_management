<?php

namespace App\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Folder;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $folder = $this->route()->parameter('folder');
        return Gate::authorize('folder.update', $folder);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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
