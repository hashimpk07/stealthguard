<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalesmenController;
use App\Http\Controllers\SalesController;
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
    return view('auth.login');
});
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('salesmen', [SalesmenController::class, 'index'])->name('salesmen');
Route::get('salesmen/add',[SalesmenController::class, 'create'])->name('salesmen.add');
Route::post('salesmen.store',[SalesmenController::class, 'store'])->name('salesmen.create');
Route::get('salesmen.edit/{id}',[SalesmenController::class, 'edit'])->name('salesmen.edit');
Route::post('salesmen.update',[SalesmenController::class, 'update'])->name('salesmen.update');
Route::get('salesmen.delete/{id}',[SalesmenController::class, 'destroy'])->name('salesmen.delete');
Route::get('salesmen.show/{id}',[SalesmenController::class, 'show'])->name('salesmen.show');

Route::get('sales/add',[SalesController::class, 'create'])->name('sales.add');
Route::post('sales.store',[SalesController::class, 'store'])->name('sales.create');