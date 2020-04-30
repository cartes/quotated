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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', sprintf("role:%s", \App\Role::ADMIN)]], function () {
   Route::get('/categories', "AdminController@categories")->name('category.admin');
   Route::get('categories/parent', "AdminController@categoryParent")->name('category.parent');
   Route::get('/categories_json', "AdminController@categoriesJSON")->name("admin.categories_json");
   Route::get('/category/{id}/edit/', 'AdminController@category_edit')->name('admin.category.edit');
   Route::post('/category/{id}/store/', 'AdminController@categoryStore')->name('admin.category.store');
   Route::post('/create/category/', "AdminController@category_create")->name('admin.category.store');
});
