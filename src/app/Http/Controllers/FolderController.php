<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use App\Models\Image;
use App\Http\Requests\Folder\StoreRequest;
use App\Http\Requests\Folder\UpdateRequest;
use App\UseCases\Folder\StoreAction;
use App\UseCases\Folder\UpdateAction;
use App\UseCases\Folder\DestroyAction;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::where('user_id', Auth::id())->paginate();

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

    public function store(StoreRequest $request, StoreAction $action)
    {
        $action($request);
            
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

    public function update(UpdateRequest $request, Folder $folder, UpdateAction $action)
    {
        $action($request, $folder);

        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダ情報を変更しました。']);
    }

    public function destroy(Folder $folder, DestroyAction $action)
    {
        $this->authorize('destroy', [Folder::class, $folder]);

        $action($folder);

        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダを削除しました。']);
    }
}
