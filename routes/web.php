<?php

use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\HomeController;
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

Route::get('/', "HomeController@index");
Route::get('login', "LoginController@showLoginForm")->name('login');
Route::get('register', "Auth\RegisterController@showRegistrationForm")->name('register');
Route::post('/buscar', [HomeController::class, 'search'])->name('buscar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);

    if (File::exists($file)) {
        return Image::make($file)->response();
    }
});

Route::get('/imgprod/{path}/{id}/{attachment?}', function ($path, $id, $attachment = null) {
    if ($attachment) {
        $file = sprintf('storage/%s/%s/%s', $path, $id, $attachment);
    } else {
        $file = sprintf('storage/%s/%s', $path, $id);
    }

    if (File::exists($file)) {
        return Image::make($file)->response();
    }
});

Route::get('/iframe', [HomeController::class, 'iframe']);

Route::group(['prefix' => 'product', 'middleware' => ['auth', sprintf("role:%s,%s", \App\Role::USER, \App\Role::ADMIN)]], function () {
    Route::get('/create', [ProductController::class, 'create'])->name("product.create");
    Route::get('/category/{id}/children', 'ProductController@getCategoryChildren')->name("product.category.children");
    Route::get('/category/{id}/name', "ProductController@getCategoryName")->name("product.category.name");
    Route::post('/store', "ProductController@store")->name("product.store");
    Route::get('/stored/{id}', 'HomeController@stored')->name('product.stored');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

Route::group(['prefix' => 'admin'], function () { //, 'middleware' => ['auth', sprintf("role:%s", \App\Role::ADMIN)]
    Route::get('/categories', "AdminController@categories")->name('category.admin');
    Route::get('categories/parent', "AdminController@categoryParent")->name('category.parent');
    Route::get('/categories_json', "AdminController@categoriesJSON")->name("admin.categories_json");
    Route::get('/category/{id}/edit/', 'AdminController@category_edit')->name('admin.category.edit');
    Route::post('/category/{id}/store/', 'AdminController@categoryStore')->name('admin.category.store');
    Route::post('/create/category/', "AdminController@category_create")->name('admin.category.store');
    Route::get('/users', "AdminController@users")->name('user.admin');
    Route::get('/users_json', "AdminController@usersJson")->name('admin.users_json');
    Route::post('/user/{id}/block', "AdminController@userBlock")->name("admin.user.block");
    Route::post('/user/{id}/unblock', "AdminController@userUnblock")->name("admin.user.unblock");
    Route::get('/user/{id}/get', "AdminController@getUser")->name("admin.user.get");
    Route::post('/user/{id}/store', "AdminController@storeUser")->name("admin.user.get");
    Route::get('/ads', "AdminController@ads")->name('ads.admin');
    Route::get('/ads_json', "AdminController@adsJson")->name('admin.ads_json');
    Route::post('/ad/{id}/activate', "AdminController@adActivate")->name('ad.activate');
    Route::post('/ad/{id}/deactivate', "AdminController@adDeactivate")->name('ad.deactivate');
});

Route::group(['prefix' => 'posts'], function() {
    Route::get('/list', [ProductController::class, 'list'])->name('posts.list');
});

Route::group(['prefix' => 'prod'], function () {
    Route::get('/{category}/{slug}', "ProductController@detail")->name('product.detail');
});

Route::group(['prefix' => 'category'], function() {
    Route::get('/{slug}', [CategoryController::class, 'posts']);
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/contact/{id}', [SellerController::class, 'contactInfo']);
    Route::get('/images/{id}', 'ProductController@getImages');
    Route::get('/category/{id?}', [CategoryController::class, 'getCategories']);
    Route::get('/categories/', 'CategoryController@getCategories');
    Route::get('/product/detail/{id}', [ProductController::class, 'getProductoDetail']);
    Route::delete('/product/image/{id}', [ProductController::class, 'deleteImage']);
    Route::post('/product/update/', [ProductController::class, 'updateProduct']);
    Route::post('/producto/publica', [CategoryController::class, 'create']);
    Route::get('/products/', [ProductController::class, 'APIproducts']);
});
