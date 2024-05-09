<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersAndRole\RoleController;
use App\Http\Controllers\UsersAndRole\UserController;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('index');

})->middleware(['auth', 'verified'])->name('dashboard');
//Route::get('user',[UserController::class,'index']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('company',CompanyController::class);
    //    Route::resource('deal');
//    Route::resource('customer');

//    Route::resource('product');
//    Route::resource('journey');
//    Route::resource('settings');
//    Route::resource('user',UserController::class);
});

require __DIR__.'/auth.php';
