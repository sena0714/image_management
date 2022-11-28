<?php

namespace App\UseCases\Folder;

use App\Http\Requests\Folder\StoreRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class StoreAction
{
    public function __invoke(StoreRequest $request)
    {
        $folder = $request->makeFolder();
        $folder->user_id = Auth::id();
        $folder->save();

        if (isset($request->images)) {
            foreach ($request->images as $imageId) {
                Image::where('id', $imageId)->update(['folder_id' => $folder->id]);
            }
        }
    }
}