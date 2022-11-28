<?php

namespace App\UseCases\Folder;

use App\Http\Requests\Folder\UpdateRequest;
use App\Models\Image;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class UpdateAction
{
    public function __invoke(UpdateRequest $request, Folder $folder)
    {
        $folder->user_id = Auth::id();
        $folder->name = $request->name;
        $folder->save();
        
        // チェックが入っていない画像との関連付けをなくす為、一度変更するフォルダと画像との関連付けを全てなくす
        Image::where('folder_id', $folder->id)->update(['folder_id' => null]);

        if (isset($request->images)) {
            foreach ($request->images as $imageId) {
                Image::where('id', $imageId)->update(['folder_id' => $folder->id]);
            }
        }
    }
}