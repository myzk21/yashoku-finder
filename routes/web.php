<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;


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

Route::get('/', function () {
    return view('home');
})->name('home');

//レシピ一覧画面
Route::get('/recipes/index', [RecipeController::class, 'index'])->name('recipe.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //レシピ作成
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipe.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipe.store');

    //レシピ編集
    Route::get('/recipes/edit/{id}', [RecipeController::class, 'edit'])->name('recipe.edit');
    Route::patch('/recipes/update/{id}', [RecipeController::class, 'update'])->name('recipe.update');

    //レシピ削除
    Route::delete('/recipes/destroy/{id}', [RecipeController::class, 'destroy'])->name('recipe.destroy');

    //レビュー
    Route::post('/recipes/{id}/review', [ReviewController::class, 'store'])->name('review.store');


    //プロフィール
});
//レシピ詳細
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipe.show');


require __DIR__.'/auth.php';
