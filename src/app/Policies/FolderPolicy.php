<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Folder;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Folder $folder)
    {
        return $user->hasFolder($folder)
            ? $this->allow()
            : $this->deny('このフォルダを所持していません。');
    }

    public function update(User $user, Folder $folder)
    {
        return $user->hasFolder($folder)
            ? $this->allow()
            : $this->deny('このフォルダを所持していません。');
    }

    public function destroy(User $user, Folder $folder)
    {
        return $user->hasFolder($folder)
            ? $this->allow()
            : $this->deny('このフォルダを所持していません。');
    }
}
