<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login',[AuthController::class,'LoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/register',[AuthController::class,'RegisterForm'])->name('register');
Route::post('/register',[AuthController::class,'register']);


Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[EmployeeController::class,'dashboard'])->name('dashboard');
        Route::get('/employees',[EmployeeController::class,'index'])->name('list-employee');
    Route::get('/employees/add',[EmployeeController::class,'add'])->name('employees.add');
    Route::post('/employees',[EmployeeController::class,'store'])->name('employees.store');
    Route::get('/employees/{id}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
    Route::put('/employees/{id}',[EmployeeController::class,'update'])->name('employees.update');
    Route::delete('/employees/{id}',[EmployeeController::class,'destroy'])->name('employees.destroy');
});
