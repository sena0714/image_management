<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Image\StoreRequest;
use App\Http\Requests\Image\UpdateRequest;
use App\Models\Image;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use App\UseCases\Image\StoreAction;
use App\UseCases\Image\UpdateAction;
use App\UseCases\Image\DestroyAction;
class ImageController extends Controller
{
    public function index()
    {
        $images = Image::where('user_id', Auth::id())->paginate(8);
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(StoreRequest $request, StoreAction $action)
    {
        $user = Auth::user();
        $image = $request->makeImage();

        $action($request, $user, $image);

        return redirect()
            ->route('images.index')
            ->with(['status' => 'info', 'flashMessage' => '画像を登録しました。']);
    }

    public function edit(Image $image)
    {
        $this->authorize('edit', [Image::class, $image]);

        return view('images.edit', compact('image'));
    }

    public function update(UpdateRequest $request, Image $image, UpdateAction $action)
    {
        $action($request, $image);

        return redirect()
            ->route('images.index')
            ->with(['status' => 'info', 'flashMessage' => '画像情報を変更しました。']);
    }

    public function destroy(Image $image, DestroyAction $action)
    {
        $this->authorize('destroy', [Image::class, $image]);

        $action($image);

        return redirect()
            ->route('images.index')
            ->with(['status' => 'info', 'flashMessage' => '画像情報を削除しました。']);
    }

    public function imageList()
    {
        $folders = Folder::where('user_id', Auth::id())->get();

        $images = Image::where('user_id', Auth::id())->paginate(8);

        return view('images.image_list', compact('folders', 'images'));
    }

    public function filteringImageList(Folder $folder)
    {
        $this->authorize('filteringImageList', [Image::class, $folder]);

        $folders = Folder::where('user_id', Auth::id())->get();

        $specifiedFolderId = $folder->id;
        $images = Image::where('user_id', Auth::id())->where('folder_id', $specifiedFolderId)->paginate(8);

        return view('images.image_list', compact('folders', 'specifiedFolderId', 'images'));
    }

    public function download(Image $image)
    {
        $this->authorize('download', [Image::class, $image]);

        return Storage::download('public/images/'.$image->filename);
    }
}
