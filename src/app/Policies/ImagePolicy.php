<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Image;
use App\Models\Folder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Image $image)
    {
        return $user->hasImage($image)
            ? $this->allow()
            : $this->deny('この画像を所持していません。');
    }

    public function update(User $user, Image $image)
    {
        return $user->hasImage($image)
            ? $this->allow()
            : $this->deny('この画像を所持していません。');
    }

    public function destroy(User $user, Image $image)
    {
        return $user->hasImage($image)
            ? $this->allow()
            : $this->deny('この画像を所持していません。');
    }

    public function filteringImageList(User $user, Folder $folder)
    {
        return $user->hasFolder($folder)
        ? $this->allow()
        : $this->deny('このフォルダを所持していません。');
    }

    public function download(User $user, Image $image)
    {
        return $user->hasImage($image)
            ? $this->allow()
            : $this->deny('この画像を所持していません。');
    }
}
