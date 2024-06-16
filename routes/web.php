<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Journey\JourneyController;
use App\Http\Controllers\Lead\LeadController;
use App\Http\Controllers\Product\ProductController;
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
    Route::resource('client',ClientController::class);
    Route::resource('journey',JourneyController::class);
    Route::get('index_lead',[LeadController::class,'index'])->name('lead.index');
    Route::put('update_lead',[LeadController::class,'update'])->name('lead.update');
    Route::get('show_lead/{id}',[LeadController::class,'show'])->name('lead.show');
    Route::get('edit_lead/{id}',[LeadController::class,'edit'])->name('lead.edit');
    Route::put('lead_archive/{id}',[LeadController::class,'lead_archive'])->name('lead.archive');
    Route::get('index_archive',[LeadController::class,'index_archive'])->name('index.archive');
    Route::post('restore_client/{id}',[LeadController::class,'restore_client'])->name('restore.client');
    Route::resource('product',ProductController::class);
});

require __DIR__.'/auth.php';
