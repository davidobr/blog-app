<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

Route::get('/', [ArticleController::class, 'articles_on_homepage'], function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [ArticleController::class, 'user_articles_on_dashboard'], function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/create', function () {
    return view('create');
})->middleware(['auth'])->name('create');

Route::post('/create', [ArticleController::class, 'create_article']);

Route::get('/view', [ArticleController::class, 'view_article'],function () {
    return view('view/{article_id}');
})->name('view');

/*Route::post('/view', [ArticleController::class, 'create_article'], function (){
    return view('/view/{article_id}');
});*/

require __DIR__.'/auth.php';
