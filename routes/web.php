<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SuscripcionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('welcome');
    return redirect('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

    Route::prefix('/rol')->group(function(){
        Route::get('/listado', [RolController::class, 'listado'])->name('rol.listado');
        Route::post('/ajaxListado', [RolController::class, 'ajaxListado'])->name('rol.ajaxListado');
        Route::post('/guardarRol', [RolController::class, 'guardarRol'])->name('rol.guardarRol');
        Route::post('/eliminarRol', [RolController::class, 'eliminarRol'])->name('rol.eliminarRol');
    });

    Route::prefix('/empresa')->group(function(){
        Route::get('/listado', [EmpresaController::class, 'listado'])->name('empresa.listado');
        Route::post('/ajaxListado', [EmpresaController::class, 'ajaxListado'])->name('empresa.ajaxListado');
        Route::post('/guardarEmpresa', [EmpresaController::class, 'guardarEmpresa'])->name('empresa.guardarEmpresa');
        Route::post('/eliminarEmpresa', [EmpresaController::class, 'eliminarEmpresa'])->name('empresa.eliminarEmpresa');
    });

    Route::prefix('/sucursal')->group(function(){
        Route::get('/listado', [SucursalController::class, 'listado'])->name('sucursal.listado');
        Route::post('/ajaxListado', [SucursalController::class, 'ajaxListado'])->name('sucursal.ajaxListado');
        Route::post('/guardarSucursal', [SucursalController::class, 'guardarSucursal'])->name('sucursal.guardarSucursal');
        Route::post('/eliminarSucursal', [SucursalController::class, 'eliminarSucursal'])->name('sucursal.eliminarSucursal');
    });

    Route::prefix('/plan')->group(function(){
        Route::get('/listado', [PlanController::class, 'listado'])->name('plan.listado');
        Route::post('/ajaxListado', [PlanController::class, 'ajaxListado'])->name('plan.ajaxListado');
        Route::post('/guardarPlan', [PlanController::class, 'guardarPlan'])->name('plan.guardarPlan');
        Route::post('/eliminarPlan', [PlanController::class, 'eliminarPlan'])->name('plan.eliminarPlan');
    });

    Route::prefix('/suscripcion')->group(function(){
        Route::get('/listado', [SuscripcionController::class, 'listado'])->name('suscripcion.listado');
        Route::post('/ajaxListado', [SuscripcionController::class, 'ajaxListado'])->name('suscripcion.ajaxListado');
        Route::post('/guardarSuscripcion', [SuscripcionController::class, 'guardarSuscripcion'])->name('suscripcion.guardarSuscripcion');
        Route::post('/eliminarSuscripcion', [SuscripcionController::class, 'eliminarSuscripcion'])->name('suscripcion.eliminarSuscripcion');
    });
});
require __DIR__.'/auth.php';
