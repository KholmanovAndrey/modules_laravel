<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::put('/gallery/{gallery}/publication', [\App\Http\Controllers\GalleryController::class, 'publication'])
    ->name('gallery.publication');
Route::put('/gallery/{gallery}/add-images', [\App\Http\Controllers\GalleryController::class, 'addImages'])
    ->name('gallery.add-images');
Route::resource('/gallery', \App\Http\Controllers\GalleryController::class);

Route::put('/gallery-image/{gallery}/publication', [\App\Http\Controllers\GalleryImageController::class, 'publication'])
    ->name('gallery-image.publication');
Route::resource('/gallery-image', \App\Http\Controllers\GalleryImageController::class);

require __DIR__.'/auth.php';
