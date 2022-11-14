<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use App\Models\Image;

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
        $images = Image::where('user_id', Auth::id())->get();

        return view('folders.create', compact('images'));
    }

    public function store(Request $request)
    {
        dump($request);
        exit;
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
