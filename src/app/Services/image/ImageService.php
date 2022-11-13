<?php
namespace App\Services\image;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function upload($imageFile, $folderName)
    {
        $fileName = uniqid(rand().'_').'.'.$imageFile->extension();
        Storage::putFileAs('public/'.$folderName, $imageFile, $fileName);

        return $fileName;
    }
}