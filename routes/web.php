<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/subadmin', function () {
    return view('subadmin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/user-profile', [HomeController::class, 'profile']);
    Route::post('profile', [HomeController::class, 'profile_update']);
    Route::post('posts', [PostController::class, 'posts']);
    Route::get('/view-posts', [PostController::class, 'view_posts']);
    Route::post('/update_posts', [PostController::class, 'update_post']);
    Route::get('delete/{id}', [PostController::class, 'delete']);
});;
