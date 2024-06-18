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
    return view('posts');
});

Route::get('posts/{post}', function ($post) {
    $path = __DIR__ . "/../resources/posts/{$post}.html";

    if (! file_exists($path)) {
        // abort(404)
        return redirect('/');
    }

    $postContent = file_get_contents($path);

    return view('post', [
        'post' => $postContent
    ]);
})->where('post', '[A-z_\-]+');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
