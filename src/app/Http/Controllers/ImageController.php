<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\requests\image\StoreRequest;
use App\Http\requests\image\UpdateRequest;
use App\Models\Image;
use App\Services\image\ImageService;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function index()
    {
        $images = Image::where('user_id', Auth::id())->get();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(StoreRequest $request)
    {
        $imageFile = $request->file('image');
        $imageService = new ImageService();
        $fileName = $imageService->upload($imageFile, 'images');

        Image::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'filename' => $fileName
        ]);
        
        return redirect()
            ->route('images.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => '画像を登録しました。']);
    }

    public function edit(Image $image)
    {
        $this->authorize('edit', [Image::class, $image]);

        return view('images.edit', compact('image'));
    }

    public function update(UpdateRequest $request, Image $image)
    {
        $this->authorize('update', [Image::class, $image]);

        $image->title = $request->title;

        if ($request->file('image')) {
            $originalFilePath = 'storage/images/'.$image->filename;
            if (Storage::exists($originalFilePath)) {
                Storage::delete($originalFilePath);
            }

            $imageFile = $request->file('image');
            $imageService = new ImageService();
            $fileName = $imageService->upload($imageFile, 'images');

            $image->filename = $fileName;
        }

        $image->save();

        return redirect()
            ->route('images.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => '画像情報を変更しました。']);
    }

    public function destroy(Image $image)
    {
        $this->authorize('delete', [Image::class, $image]);

        $filePath = 'storage/images/'.$image->filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $image->delete();

        return redirect()
            ->route('images.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => '画像情報を削除しました。']);
    }
}
