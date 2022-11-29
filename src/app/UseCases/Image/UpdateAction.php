<?php

namespace App\UseCases\Image;

use App\Http\Requests\Image\UpdateRequest;
use App\Models\Image;
use App\Services\Image\ImageUploader;
use App\Services\Image\ImageDestroyer;

class UpdateAction
{
    public function __invoke(UpdateRequest $request, Image $image):void
    {
        $image->title = $request->title;

        if ($request->file('image')) {
            $originalFilePath = 'storage/images/'.$image->filename;
            $imageDestroyer = app()->make(ImageDestroyer::class);
            $imageDestroyer->destroy($originalFilePath);

            $imageFile = $request->file('image');
            $imageUploader = app()->make(ImageUploader::class);
            $fileName = $imageUploader->upload($imageFile, 'images');

            $image->filename = $fileName;
        }

        $image->save();
    }
}