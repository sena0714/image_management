<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Image;
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

    public function delete(User $user, Image $image)
    {
        return $user->hasImage($image)
            ? $this->allow()
            : $this->deny('この画像を所持していません。');
    }
}
