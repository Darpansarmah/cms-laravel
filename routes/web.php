<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Blog\PostsController;
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

Route::resource('/', 'WelcomeController');

// Route::get('blog/posts/{post}', [PostsController::class, 'show'])->name('blog.show');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('tags', 'TagController');
Route::resource('posts', 'PostController')->middleware('auth');
Route::get('posts/category/{category}', 'PostController@category')->name('posts.category');
Route::get('posts/tags/{tag}', 'PostController@tag')->name('posts.tag');
Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
Route::put('restore-posts/{post}', 'PostController@restore')->name('restore-posts');

});

Route::resource('users', 'UserController');
Route::post('users/{user}/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
Route::post('users/{user}/make-writer', 'UserController@makeWriter')->name('users.make-writer');
