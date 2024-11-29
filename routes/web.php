<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UnlogShoppingController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Định nghĩa route mặc định '/' trỏ đến trang chủ trong IndexController
Route::get('/', [IndexController::class, 'index'])->name('home');

// Route cho trang sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route hiển thị form đăng nhập và xử lý đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route hiển thị form đăng ký và xử lý đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route để xử lý đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

// Route dành cho sản phẩm (chỉ cho phép người dùng đăng nhập thực hiện các thao tác thêm, sửa, xóa)
Route::middleware(['auth'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Form thêm sản phẩm
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Lưu sản phẩm mới
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Form sửa sản phẩm
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Cập nhật sản phẩm
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Xóa sản phẩm
});

// Route chi tiết sản phẩm
Route::get('/products/{id}', [DetailController::class, 'show'])->name('products.detail');

// Route thêm bình luận cho sản phẩm
Route::post('/products/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

// Thông tin người dùng
Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/edit', [InformationController::class, 'edit'])->name('information.edit');
Route::post('/information/update', [InformationController::class, 'update'])->name('information.update');

// Quản lý giỏ hàng
Route::post('/shopping', [ShoppingController::class, 'store'])->name('shopping.store');
Route::get('/shopping', [ShoppingController::class, 'shoppingInfo'])->name('information.shopping');

// Quản lý giỏ hàng chưa đăng nhập
Route::post('/unlog-shopping/store', [UnlogShoppingController::class, 'store'])->name('unlog_shopping.store');
Route::get('/unlog-shopping', [UnlogShoppingController::class, 'showUnlogShoppingForm'])->name('information.unlog_shopping');
Route::post('/unlog-shopping/search', [UnlogShoppingController::class, 'searchByPhone'])->name('information.unlog_shopping_search');
