<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FolderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('images', ImageController::class)
->middleware('auth')
->except(['show']);

Route::prefix('image_list')
->middleware('auth')->group(function() {
    Route::get('index', [ImageController::class, 'imageList'])->name('image_list.index');
    Route::get('index/{folder}', [ImageController::class, 'filteringImageList'])->name('image_list.filtering');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('folders', FolderController::class)
->middleware('auth')
->except(['show']);

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
