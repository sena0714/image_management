<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public function upload($imageFile, $folderName)
    {
        $fileName = uniqid(rand().'_').'.'.$imageFile->extension();
        Storage::putFileAs('public/'.$folderName, $imageFile, $fileName);

        return $fileName;
    }
}