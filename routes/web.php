<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);

    if (File::exists($file)){
        return Image::make($file)->response();
    }
});

Route::group(['prefix' => 'category'], function () {
   Route::get('/categories', "AdminController@categories")->name('category.admin');
   Route::get('/categories_json', "AdminController@categoriesJSON")->name("admin.categories_json");
});
