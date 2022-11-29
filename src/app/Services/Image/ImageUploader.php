<?php
namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    /**
     * フォルダ名は語尾に「/」を付けずに渡してください
     * 例：$ImageUploader->upload($imageFile, 'images');
     */
    public function upload($imageFile, $folderName):string
    {
        $fileName = uniqid(rand().'_').'.'.$imageFile->extension();
        Storage::putFileAs('public/'.$folderName, $imageFile, $fileName);

        return $fileName;
    }
}