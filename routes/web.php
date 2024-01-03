<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

// Fallback

Route::fallback(FallbackController::class);

Route::prefix('/blog')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::get('/{id}', [PostsController::class, 'show'])->name('blog.show');

    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    Route::get('/edit/{id}', [PostsController::class, 'edit'])->whereNumber('id')->whereAlpha('name')->name('blog.edit');
    Route::patch('/update/{id}', [PostsController::class, 'update'])->name('blog.update');
    Route::delete('/{id}', [PostsController::class, 'destroy'])->whereAlpha('id')->name('blog.delete');
});

Route::get('/article/{id}', [PostsController::class, 'article'])->name('blog.article');

// Estudos

Route::get('/deprecated', function () {
    // Debugbar::startMeasure('Isso não e bom', 'Mensagem feia');

    // try {
    //     throw new Exception('Try Message');
    // } catch (Exception $ex) {
    //     Debugbar::addException($ex);
    // }

    return view('welcome');
});

// GET

// Multiple HTTP verbs
// Route::match(['PATCH', 'POST'], '/blog', [PostsController::class, 'index']);
// Route::any('/blog}', [PostsController::class, 'index']);
// Route::view('/blog', 'blog.blog', ['frutas' => ['manga', 'pera', 'banana']]);

/*

   GET - Requeste a resource.
   POST - Create a new resource.
   PUT - Update a resource.
   PATCH - Modify a resource.
   DELETE - Delete a resource.
   OPTIONS - Ask the server which verbs are allowed

*/
