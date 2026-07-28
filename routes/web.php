<?php

use Illuminate\Support\Facades\Route;


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


Route::get('/login',[\App\Http\Controllers\Auth\AuthController::class,'login'])->name('login');
Route::post('/login_post',[\App\Http\Controllers\Auth\AuthController::class,'login_post'])->name('login_post');
Route::get('/register',[\App\Http\Controllers\Auth\AuthController::class,'register'])->name('register');
Route::post('/register_post',[\App\Http\Controllers\Auth\AuthController::class,'register_post'])->name('register_post');
Route::post('/logout',[\App\Http\Controllers\Auth\AuthController::class,'logout'])->name('logout');


Route::get('/',[\App\Http\Controllers\Home\HomeController::class,'home'])->name('home');
Route::get('/product_details/{id}',[\App\Http\Controllers\Home\HomeController::class,'product_details'])->name('product_details');
Route::get('/shop',[\App\Http\Controllers\Home\HomeController::class,'shop'])->name('shop');
Route::get('/shop/filter', [\App\Http\Controllers\Home\HomeController::class,'filter'])->name('shop.filter');
Route::get('/contact',[\App\Http\Controllers\Admin\ContactController::class,'contact'])->name('contact');
Route::post('/contact/add',[\App\Http\Controllers\Admin\ContactController::class,'store'])->name('contact.store');

Route::get('log', [\App\Http\Controllers\Admin\LogViewerController::class,'log'])->name('log');


// auth
Route::middleware('auth')->group(function () {
    Route::post('/paymentWeb',[\App\Http\Controllers\Home\PaymentController::class,'paymentWeb'])->name('paymentWeb');

    Route::get('/profile/index',[\App\Http\Controllers\Home\ProfileController::class,'index'])->name('profile.index');
    Route::patch('/profile/update/{id}',[\App\Http\Controllers\Home\ProfileController::class,'update'])->name('profile.update');

    Route::get('/basket',[\App\Http\Controllers\Home\BasketController::class,'index'])->name('basket.index');
    Route::post('/basket/add/{id}',[\App\Http\Controllers\Home\BasketController::class,'store'])->name('basket.store');
    Route::get('/basket/remove/{id}',[\App\Http\Controllers\Home\BasketController::class,'destroy'])->name('basket.destroy');

    Route::post('/comments/add/{id}',[\App\Http\Controllers\Home\CommentController::class,'store'])->name('comments.store');
    Route::post('/comments/{comment}/reply', [\App\Http\Controllers\Home\CommentController::class, 'reply'])->name('comments.reply');

    Route::get('/address',[\App\Http\Controllers\Home\AddressController::class,'index'])->name('address.index');
    Route::post('/address/add/{id}',[\App\Http\Controllers\Home\AddressController::class,'store'])->name('address.store');

    Route::get('/checkout',[\App\Http\Controllers\Home\CheckoutController::class,'checkout'])->name('checkout');

});


// admin
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('index', [\App\Http\Controllers\Admin\PanelController::class,'panel'])->name('panel.index');
    Route::resource('users',\App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles',\App\Http\Controllers\Admin\RoleController::class);


    Route::get('createUserRoles/{id}', [\App\Http\Controllers\Admin\UserController::class,'createUserRoles'])->name('create.user.roles');
    Route::post('storeUserRoles/{id}', [\App\Http\Controllers\Admin\UserController::class,'storeUserRoles'])->name('store.user.roles');


    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('sliders',\App\Http\Controllers\Admin\SliderController::class);
    Route::resource('brands',\App\Http\Controllers\Admin\BrandController::class);
    Route::resource('colors',\App\Http\Controllers\Admin\ColorController::class);
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('property_groups',\App\Http\Controllers\Admin\PropertyGroupController::class);
    Route::resource('properties',\App\Http\Controllers\Admin\PropertiesController::class);


    Route::get('indexGallery/{id}', [\App\Http\Controllers\Admin\GalleryController::class,'index'])->name('index.gallery');
    Route::get('createGallery/{id}', [\App\Http\Controllers\Admin\GalleryController::class,'create'])->name('create.gallery');
    Route::post('storeGallery/{id}', [\App\Http\Controllers\Admin\GalleryController::class,'store'])->name('store.gallery');
    Route::get('deleteGallery/{id}', [\App\Http\Controllers\Admin\GalleryController::class,'deleteGallery'])->name('delete.gallery');


    Route::get('comments/index',[\App\Http\Controllers\Admin\CommentController::class,'index'])->name('comment.index');
    Route::get('comments/show/{id}',[\App\Http\Controllers\Admin\CommentController::class,'show'])->name('comment.show');
    Route::patch('comments/accept/{id}', [\App\Http\Controllers\Admin\CommentController::class,'accept'])->name('comment.accept');
    Route::patch('comments/reject/{id}',[\App\Http\Controllers\Admin\CommentController::class,'reject'])->name('comment.reject');
    Route::delete('comments/destroy/{id}', [\App\Http\Controllers\Admin\CommentController::class,'destroy'])->name('comment.destroy');


    Route::get('baskets', [\App\Http\Controllers\Home\BasketController::class,'baskets'])->name('baskets');
    Route::get('baskets_details/{id}', [\App\Http\Controllers\Home\BasketController::class,'baskets_details'])->name('baskets_details');


    Route::get('contacts/index',[\App\Http\Controllers\Admin\ContactController::class,'index'])->name('contacts.index');
    Route::patch('contacts/read/{id}', [\App\Http\Controllers\Admin\ContactController::class,'read'])->name('contacts.read');



    // من جداول orders , order_details را از روی ویودیو اموزشی دیدم که درگاه پرداخت فیک داشت
    // جداول baskets , baskets_details رو به کمک chat gpt نوشتم که ادامه روند رو بلد نبودم داشت
//    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class,'orders'])->name('orders');
//    Route::get('order_details/{id}', [\App\Http\Controllers\Admin\OrderController::class,'order_details'])->name('order_details');
});
