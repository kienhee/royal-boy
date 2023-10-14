<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Color\ColorController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Group\GroupController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Size\SizeController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Client\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'home'])->name('index');
    Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
    Route::get('/shop/{slug}', [ClientController::class, 'productDetail'])->name('product-detail');
    Route::get('/about-us', [ClientController::class, 'about'])->name('about-us');
    Route::get('/blog', [ClientController::class, 'blog'])->name('blog');
    Route::get('/cart', [ClientController::class, 'cart'])->name('shopping-cart');
    Route::get('/get-cart', [ClientController::class, 'getCart'])->name('get-cart');
    Route::post('/cart/add-to-cart', [ClientController::class, 'addToCart'])->name('add-to-cart');
    Route::put('/cart/update-to-cart', [ClientController::class, 'updateCart'])->name('update-to-cart');
    Route::delete('/cart/remove-from-cart', [ClientController::class, 'removeFromCart'])->name('remove-from-cart');
    Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::get('/blog/{slug}', [ClientController::class, 'blogDetail'])->name('blog-detail');
});
Route::prefix('/admin-dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, "dashboard"])->name('index');
    // Quản lý bộ sưu tập
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/add', [categoryController::class, 'add'])->name('add');
        Route::post('/add', [categoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [categoryController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [categoryController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [categoryController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [categoryController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [categoryController::class, 'restore'])->name('restore');
    });
    Route::prefix('sliders')->name('slider.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/add', [SliderController::class, 'add'])->name('add');
        Route::post('/add', [SliderController::class, 'store'])->name('store');
        Route::get('/edit/{slider}', [SliderController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SliderController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [SliderController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [SliderController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [SliderController::class, 'restore'])->name('restore');
    });
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/add', [ProductController::class, 'add'])->name('add');
        Route::post('/add', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [ProductController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [ProductController::class, 'restore'])->name('restore');
    });
    Route::prefix('posts')->name('post.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/add', [PostController::class, 'add'])->name('add');
        Route::post('/add', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [PostController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [PostController::class, 'restore'])->name('restore');
    });
    Route::prefix('colors')->name('color.')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('index');
        Route::get('/add', [ColorController::class, 'add'])->name('add');
        Route::post('/add', [ColorController::class, 'store'])->name('store');
        Route::get('/edit/{color}', [ColorController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [ColorController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ColorController::class, 'delete'])->name('delete');
    });
    Route::prefix('sizes')->name('size.')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('index');
        Route::get('/add', [SizeController::class, 'add'])->name('add');
        Route::post('/add', [SizeController::class, 'store'])->name('store');
        Route::get('/edit/{size}', [SizeController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SizeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SizeController::class, 'delete'])->name('delete');
    });
    Route::prefix('tags')->name('tag.')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/add', [TagController::class, 'add'])->name('add');
        Route::post('/add', [TagController::class, 'store'])->name('store');
        Route::get('/edit/{tag}', [TagController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [TagController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TagController::class, 'delete'])->name('delete');
    });
    // Quản lý nhóm người dùng
    Route::prefix('groups')->name('group.')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/add', [GroupController::class, 'add'])->name('add');
        Route::post('/add', [GroupController::class, 'store'])->name('store');
        Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [GroupController::class, 'update'])->name('update');

        Route::delete('/delete/{id}', [GroupController::class, 'delete'])->name('delete');
    });
    // Quản lý người dùng
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'add'])->name('add');
        Route::post('/add', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [UserController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [UserController::class, 'restore'])->name('restore');
        Route::get('/account-setting', [UserController::class, 'AccountSetting'])->name('account-setting');
    });
    Route::post('/upload', [ImageController::class, 'upload'])->name('upload');
});
Route::prefix('/auth-dashboard')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
//Routes dành cho các mẫu
require __DIR__ . '/template.php';
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
