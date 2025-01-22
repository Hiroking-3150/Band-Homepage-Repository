<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CdsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will be assigned to the "web" middleware group. Make something great!
|
*/

// ホームページ
Route::get('/', [\App\Http\Controllers\TopController::class, 'top'])->name('top');

// 認証後にアクセス可能なルート（ダッシュボード）
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/blog-posted', function () {
    return view('blogs.blog_posted');
})->name('blog.posted');

// // 認証後にアクセス可能なルート（ブログ作成、編集、削除など）
// Route::middleware('auth')->group(function () {
//     // ブログ作成・編集・削除
//     Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
//     Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
//     Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
//     Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
//     Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    
//     // プロフィール編集
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// ゲストユーザー向けルート（未認証ユーザーのログイン処理）
// Route::middleware('guest')->group(function () {
    // Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    // Route::post('login', [AuthenticatedSessionController::class, 'store']);
// });

// 管理者専用のルート（認証＋管理者権限）
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', function() {
            return view('/dashboard');
        })->name('dashboard');

    // 管理者専用のブログやニュース管理
    // ブログの作成・編集・削除
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // ニュース関連(作成・編集・更新・削除)
    // Route::resource('news', NewsController::class);
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    //新CD情報作成
    Route::get('/cds/create', [CdsController::class, 'create'])->name('cds.create');

    // ログアウト
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
  
// 認証なしでアクセスできるルート
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/cds', [CdsController::class, 'index'])->name('cds.index');  
Route::post('/cds', [CdsController::class, 'store'])->name('cds.store');
Route::get('/cds/{id}', [CdsController::class, 'show'])->name('cds.show');
Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');

require __DIR__.'/auth.php';
