<?php

use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\UregisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


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

Route::post('newsletter', function() {
    request()->validate(['email'=>'required|email']);
    $mailchimp = new \MailchimpMarketing\ApiClient();
    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us17'
    ]);

    try {
        $newsletter->subscribe(request('email'));
    } catch (Exception $e) {
        throw ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')->with('success','You are now signed up for our newsletter!');
});

Route::get('/', [PostController::class, 'index']);
Route::post('post/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('uregister', [UregisterController::class, 'create'])->middleware('guest');
Route::post('uregister', [UregisterController::class, 'store'])->middleware('guest');

Route::get('ulogin', [SessionsController::class, 'create'])->middleware('guest');
Route::post('ulogin', [SessionsController::class, 'store'])->middleware('guest');

Route::post('ulogout', [SessionsController::class, 'destroy'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
