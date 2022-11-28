<?php

namespace App\UseCases\Image;

use App\Http\Requests\Image\UpdateRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Services\Image\ImageUploader;

class UpdateAction
{
    public function __invoke(UpdateRequest $request, Image $image)
    {
        $image->title = $request->title;

        if ($request->file('image')) {
            $originalFilePath = 'storage/images/'.$image->filename;
            if (Storage::exists($originalFilePath)) {
                Storage::delete($originalFilePath);
            }

            $imageFile = $request->file('image');
            $imageService = new ImageUploader();
            $fileName = $imageService->upload($imageFile, 'images');

            $image->filename = $fileName;
        }

        $image->save();
    }
}