<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Admin\AdminController;



Route::get('/', function () {
    return view('welcome');
});
Route::post('/save-editor', [EditorController::class, 'store']);

Route::get('/editor', function () {
    return view('editor');
})->middleware(['auth', 'verified'])->name('editor');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('folders', FolderController::class);
    Route::resource('folders.notes', NoteController::class);
    Route::get('/folders/{folder}/notes/{note}/edit', [NoteController::class, 'edit'])->name('folders.notes.edit');
    Route::put('/folders/{folder}/notes/{note}', [NoteController::class, 'update'])->name('folders.notes.update');

});
Route::post('/upload-image', [ImageUploadController::class, 'upload']);

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/notes', [AdminController::class, 'notes'])->name('notes');
    Route::delete('/notes/{note}', [AdminController::class, 'destroyNote'])->name('notes.destroy');
});

require __DIR__.'/auth.php';
