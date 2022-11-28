<?php

namespace App\UseCases\Folder;

use App\Models\Image;
use App\Models\Folder;

class DestroyAction
{
    public function __invoke(Folder $folder)
    {
        Image::where('folder_id', $folder->id)->update(['folder_id' => null]);    

        $folder->delete();
    }
}