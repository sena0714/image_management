<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use App\Models\Image;
use App\Http\Requests\folder\StoreRequest;

class FolderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $id = $request->route()->parameter('folder');
    
            if (isset($id)) {
                $folderUserId = (int) Folder::findOrFail($id)->user->id;
                if ($folderUserId !== Auth::id()) {
                    abort(404);
                }
            }
    
            return $next($request);
        });
    }
    
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

        foreach ($request->images as $imageId) {
            Image::where('id', $imageId)->update(['folder_id' => $folder->id]);
        }
            
        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダを登録しました。']);
    }

    public function edit($id)
    {
        $folder = Folder::findOrFail($id);

        $images = Image::where('user_id', Auth::id())
                        ->where(function($images) use($id) {
                            $images->whereNull('folder_id')
                                ->orWhere('folder_id', $id);
                        })
                        ->get();

        return view('folders.edit', compact('folder', 'images'));
    }

    public function update(Request $request, $id)
    {
        Folder::where('id', $id)->update(['name' => $request->folder_name]);

        // チェックが入っていない画像との関連付けをなくす為、一度変更するフォルダと画像との関連付けを全てなくす
        Image::where('folder_id', $id)->update(['folder_id' => null]);

        foreach ($request->images as $imageId) {
            Image::where('id', $imageId)->update(['folder_id' => $id]);
        }

        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダ情報を変更しました。']);
    }

    public function destroy($id)
    {
        Image::where('folder_id', $id)->update(['folder_id' => null]);    

        Folder::destroy($id);

        return redirect()->route('folders.index')
            ->with(['flashStatus' => 'info', 'flashMessage' => 'フォルダを削除しました。']);
    }
}
