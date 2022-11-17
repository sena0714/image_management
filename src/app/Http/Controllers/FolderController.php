<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use App\Models\Image;
use App\Http\Requests\folder\StoreRequest;
use App\Http\Requests\folder\UpdateRequest;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::where('user_id', Auth::id())->get();

        $images = Image::where('user_id', Auth::id())->get();

        return view('folders.index', compact('folders'));
    }

    public function create()
    {
        $images = Image::where('user_id', Auth::id())
                        ->whereNull('folder_id')
                        ->get();

        return view('folders.create', compact('images'));
    }

    public function store(StoreRequest $request)
    {
        $folder = Folder::create([
            'user_id' => Auth::id(),
            'name' => $request->folder_name
        ]);

        if (isset($request->images)) {
            foreach ($request->images as $imageId) {
                Image::where('id', $imageId)->update(['folder_id' => $folder->id]);
            }
        }
            
        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダを登録しました。']);
    }

    public function edit(Folder $folder)
    {
        $this->authorize('edit', [Folder::class, $folder]);

        $folderId = $folder->id;
        $images = Image::where('user_id', Auth::id())
                    ->where(function($images) use($folderId) {
                        $images->whereNull('folder_id')
                            ->orWhere('folder_id', $folderId);
                    })
                    ->get();

        return view('folders.edit', compact('folder', 'images'));
    }

    public function update(UpdateRequest $request, Folder $folder)
    {
        $this->authorize('update', [Folder::class, $folder]);
        
        $folder->update(['name' => $request->folder_name]);

        // チェックが入っていない画像との関連付けをなくす為、一度変更するフォルダと画像との関連付けを全てなくす
        Image::where('folder_id', $folder->id)->update(['folder_id' => null]);

        if (isset($request->images)) {
            foreach ($request->images as $imageId) {
                Image::where('id', $imageId)->update(['folder_id' => $folder->id]);
            }
        }

        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダ情報を変更しました。']);
    }

    public function destroy(Folder $folder)
    {
        $this->authorize('delete', [Folder::class, $folder]);

        Image::where('folder_id', $folder->id)->update(['folder_id' => null]);    

        $folder->delete();

        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダを削除しました。']);
    }
}
