<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\requests\image\StoreRequest;
use App\Models\Image;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function index()
    {
        return view('images.index');
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(StoreRequest $request)
    {
        $imageFile = $request->file('image');
        $imageService = app()->make(ImageService::class);
        $fileName = $imageService->upload($imageFile, 'images');

        Image::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'filename' => $fileName
        ]);
        
        return redirect()->route('images.index')->with(['flashStatus' => 'info', 'flashMessage' => '画像を登録しました。']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
