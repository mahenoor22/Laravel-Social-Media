<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
})->name('home');
Route::post('/signup', [
    'uses' => 'App\Http\Controllers\UserController@postSignUp',
    'as' => 'signup'
]);

Route::post('/signin', [
    'uses' => 'App\Http\Controllers\UserController@postSignIn',
    'as' => 'signin'
]);
Route::get('/dashboard', [
    'uses' => 'App\Http\Controllers\PostController@getDashboard',
    'as' => 'dashboard',
    'middleware'=>'auth'
]);

Route::post('/createpost', [
    'uses' => 'App\Http\Controllers\PostController@postCreatePost',
    'as' => 'post.create'
]);
Route::get('/post-delete/{post_id}', [
    'uses' => 'App\Http\Controllers\PostController@getDeletePost',
    'as' => 'post.delete',
    'middleware'=>'auth'
]);
Route::get('/logout',[
    'uses'=>'App\Http\Controllers\UserController@getLogout',
    'as'=>'logout'
]);