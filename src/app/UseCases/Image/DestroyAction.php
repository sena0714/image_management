<?php

namespace App\UseCases\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Services\Image\ImageDestroyer;

class DestroyAction
{
    public function __invoke(Image $image):void
    {
        $filePath = 'storage/images/'.$image->filename;
        $imageDestroyer = app()->make(ImageDestroyer::class);
        $imageDestroyer->destroy($filePath);

        $image->delete();
    }
}