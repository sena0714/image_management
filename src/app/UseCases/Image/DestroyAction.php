<?php

namespace App\UseCases\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class DestroyAction
{
    public function __invoke(Image $image)
    {
        $filePath = 'storage/images/'.$image->filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $image->delete();
    }
}