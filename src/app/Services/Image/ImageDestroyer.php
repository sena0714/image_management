<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;

class ImageDestroyer
{
    public function destroy($filePath):void
    {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}