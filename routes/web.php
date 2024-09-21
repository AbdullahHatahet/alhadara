<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth','language']);
Route::resource('/products', ProductController::class)->middleware(['auth','language']);
Route::resource('categories', CategoryController::class)->middleware(['auth','language']);
Route::post('categories/{id}', [CategoryController::class,'update'])->name('categories.update')->middleware(['auth']);

Route::get('locale/{lang}', function($lang){
    session()->put('lang', $lang);
    return redirect()->back();
})->name('locale');

require __DIR__.'/auth.php';