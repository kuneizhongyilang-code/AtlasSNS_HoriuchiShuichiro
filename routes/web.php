<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
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



require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
// トップページ
Route::get('top', [PostsController::class, 'index'])->name('top');
// 投稿登録
Route::post('posts', [PostsController::class, 'store'])->name('posts.store');
// 投稿編集
Route::put('posts/{id}', [PostsController::class, 'update'])->name('posts.update');
// 投稿削除
Route::delete('posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
// プロフィールページ
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
// ユーザー検索ページ
Route::get('search', [UsersController::class, 'index'])->name('search');
// フォローリストページ
Route::get('follow-list', [PostsController::class, 'index'])->name('follow-list');
// フォロワーリストページ
Route::get('follower-list', [PostsController::class, 'index'])->name('follower-list');
});
