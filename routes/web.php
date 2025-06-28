<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\NotaIngresoMaterialController;
use App\Http\Controllers\NotaSalidaMaterialController;
use App\Http\Controllers\NotaIngresoProductoController;
use App\Http\Controllers\NotaSalidaProductoController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('Main.main');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/materiales/notaingreso/user', [NotaIngresoMaterialController::class, 'indexuser'])->name('materiales.indexuser');
Route::prefix('user')->middleware(['auth', 'checkrole:user'])->group(function () {
    Route::get('/', [UserController::class, 'homeUser'])->name('user.home');

    Route::prefix('/materiales')->group(function () {
        Route::get('/', [MaterialController::class, 'indexUser'])->name('user.materiales.index');
        // Rutas para la gestión de notas de ingreso y salida de materiales
        Route::post('/notaingreso/guardar', [NotaIngresoMaterialController::class, 'store'])->name('materiales.notaingreso.store');
        Route::get('/notaingreso', [NotaIngresoMaterialController::class, 'indexuser'])->name('materiales.indexuser');
        Route::post('/notaingreso/guardar', [NotaIngresoMaterialController::class, 'store'])->name('notaingreso.store');
        Route::post('/notaingreso/{id}/guardar-detalles', [NotaIngresoMaterialController::class, 'storeDetalles'])->name('notaingreso.detalles.store');

        

        Route::get('/notasalida', [NotaSalidaMaterialController::class, 'indexuser'])->name('materiales.notasalida.index');
        Route::get('/notasalida/ver/{id}', [NotaSalidaMaterialController::class, 'show'])->name('materiales.notasalida.show');
        Route::get('/notasalida/pdf/{id}', [NotaSalidaMaterialController::class, 'exportarPdf'])->name('nota.salida.pdf');
        // Nota de Salida para User
        Route::get('/materiales/notasalida/user', [NotaSalidaMaterialController::class, 'indexuser'])->name('materiales.notasalida.indexuser');
    });

    Route::prefix('/productos')->group(function(){
        Route::get('/', [ProductController::class, 'indexUser'])->name('user.products.index');
        Route::get('/notaingreso',[NotaIngresoProductoController::class,'indexuser'])->name('productos.indexuser');
        Route::post('/notaingreso',[NotaIngresoProductoController::class,'store'])->name('productos.notaingreso.store');

        Route::get('/notasalida', [NotaSalidaProductoController::class, 'indexuser'])->name('user.productos.notasalida.index');
    });
});

Route::prefix('admin')->middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'homeAdmin'])->name('admin.home');

    Route::get('/reportes', [ReportController::class, 'index'])->name('reportes.index');

    Route::get('/chatbot', [ChatbotController::class, 'mostrarChatbot'])->name('chatbot.index');
    Route::post('/chatbot', [ChatbotController::class, 'handle']);

    Route::get('/perfiles', [UserController::class, 'index'])->name('perfiles.index');
    Route::post('/perfiles', [UserController::class, 'store'])->name('perfiles.store');

    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    Route::get('/proveedores/registrar', function () {
        return view('Admin.Proveedores.nuevoProveedor');
    });

    Route::prefix('materiales')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materiales.index');
        Route::post('/agregar', [MaterialController::class, 'store'])->name('material.store');
        Route::delete('/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');
        Route::put('/{id}', [MaterialController::class, 'update'])->name('material.update');

        Route::get('/notaingreso', [NotaIngresoMaterialController::class, 'index'])->name('materiales.notaingreso.index');
        Route::get('/notaingreso/ver/{nota}', [NotaIngresoMaterialController::class, 'show'])->name('materiales.notaingreso.show');
        Route::get('/notaingreso/{id}/pdf', [NotaIngresoMaterialController::class, 'exportarPDF'])->name('nota.ingreso.pdf');

        Route::get('/notasalida', [NotaSalidaMaterialController::class, 'index'])->name('materiales.notasalida.index');
        Route::get('/notasalida/ver/{id}', [NotaSalidaMaterialController::class, 'show'])->name('materiales.notasalida.show');
        Route::get('/notasalida/pdf/{id}', [NotaSalidaMaterialController::class, 'exportarPdf'])->name('nota.salida.pdf');
    });

    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('/productos/agregar', [ProductController::class, 'store'])->name('products.store');

        Route::get('/notaingreso', [NotaIngresoProductoController::class, 'index'])->name('productos.notaingreso.index');
        Route::get('/notaingreso/ver/{nota}', [NotaIngresoProductoController::class, 'show'])->name('productos.notaingreso.show');
        Route::get('/notaingreso/{id}/pdf', [NotaIngresoProductoController::class, 'exportarPDF'])->name('productos.notaingreso.pdf');

        Route::get('/notasalida', [NotaSalidaProductoController::class, 'index'])->name('productos.notasalida.index');
        Route::get('/notasalida/ver/{id}', [NotaSalidaProductoController::class, 'show'])->name('productos.notasalida.show');
        Route::get('/notasalida/pdf/{id}', [NotaSalidaProductoController::class, 'exportarPdf'])->name('productos.notasalida.pdf');
    });

});
















// Route::post('/materiales/guardar', [MaterialController::class, 'guardarCambios'])->name('materiales.guardar');


