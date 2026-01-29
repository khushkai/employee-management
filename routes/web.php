<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ApicrudController;


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

    Route::get('/pages/about',[PageController::class,'about'])->name('about');
    Route::get('/pages/contact',[PageController::class,'contact'])->name('contact');
    Route::get('/pages/services',[PageController::class,'services'])->name('services');
    Route::get('/pages/products',[PageController::class,'product'])->name('products');
    // Route::middleware(['auth','is_admin'])->group(function () {

    
    Route::get('/test', [TestController::class, 'index'])->name('test.index');
    Route::get('/test-cursor', [TestController::class, 'cursorIndex'])->name('test.cursor');
    Route::get('/test-process', [TestController::class, 'processLargeDataset'])->name('test.process');
    Route::get('/test/create', [TestController::class,'create'])->name('test.create');
    Route::post('/test', [TestController::class,'store'])->name('test.store');
    Route::get('/test/{test}/edit', [TestController::class,'edit'])->name('test.edit');
    Route::put('/test/{test}', [TestController::class,'update'])->name('test.update');
    Route::delete('/test/{test}', [TestController::class,'destroy'])->name('test.destroy');
    Route::get('/test/{test}', [TestController::class,'show'])->name('test.show');
    Route::get('/test-export', [TestController::class, 'export'])->name('test.export');
    Route::post('/test/import', [TestController::class, 'import'])->name('test.import');

    Route::get('/crud',[CrudController::class,'index'])->name('crud.index');
    Route::get('/crud/add',[CrudController::class,'create'])->name('crud.create');
    Route::post('/crud/store',[CrudController::class,'store'])->name('crud.store');
    Route::get('/crud/{crud}/edit',[CrudController::class,'edit'])->name('crud.edit');
    Route::put('/crud/{crud}',[CrudController::class,'update'])->name('crud.update');
    Route::delete('/crud/{crud}',[CrudController::class,'destroy'])->name('crud.destroy');
    Route::get('/test/{test}', [TestController::class,'show'])->name('crud.show');
   
    Route::get('/demo',[DemoController::class,'index'])->name('demo.index');
    Route::get('/demo/add',[DemoController::class,'create'])->name('demo.create');
    Route::post('/demo/store',[DemoController::class,'store'])->name('demo.store');
    Route::get('/demo/{demo}/edit',[DemoController::class,'edit'])->name('demo.edit');
    Route::put('/demo/{demo}',[DemoController::class,'update'])->name('demo.update');
    Route::delete('/demo/{demo}',[DemoController::class,'destroy'])->name('demo.destroy');
    Route::get('/demo/{demo}', [DemoController::class,'show'])->name('demo.show');

    Route::get('/api_crud', [ApicrudController::class,'index'])->name('api_crud.index');
    Route::get('/api_crud/add', [ApicrudController::class,'create'])->name('api_crud.create');
    Route::post('/api_crud/store', [ApicrudController::class,'store'])->name('api_crud.store');
    Route::get('/api_crud/{id}/edit', [ApicrudController::class,'edit'])->name('api_crud.edit');
    Route::put('/api_crud/{id}', [ApicrudController::class,'update'])->name('api_crud.update');
    Route::delete('/api_crud/{id}', [ApicrudController::class,'destroy'])->name('api_crud.destroy');

    /* ⚠️ ALWAYS LAST */
    Route::get('/api_crud/{id}', [ApicrudController::class,'show'])->name('api_crud.show');

});
   
// });