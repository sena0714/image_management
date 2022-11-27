<?php

namespace App\UseCases\Image;

use App\Http\Requests\image\StoreRequest;
use App\Models\User;
use App\Models\Image;
use App\Services\image\ImageUploader;

class StoreAction
{
    public function __invoke(StoreRequest $request, User $user, Image $image)
    {
        $imageFile = $request->file('image');
        $imageService = app()->make(ImageUploader::class);
        $fileName = $imageService->upload($imageFile, 'images');

        $image->user_id = $user->id;
        $image->filename = $fileName;
        $image->save();
        return $image;
    }
}