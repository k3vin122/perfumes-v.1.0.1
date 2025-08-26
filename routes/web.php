<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentaCreditoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfumeController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DinerobancoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Response;


// ----------------------------------
// RUTAS PÚBLICAS (Autenticación)
// ----------------------------------

// Ruta raíz redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/archivos/{path}', function ($path) {
    $path = storage_path('app/public/' . $path);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('path', '.*');



Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Ruta para el cierre de sesión
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ----------------------------------
// RUTAS PROTEGIDAS POR AUTH Y VERIFICACIÓN DE EMAIL
// ----------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/perfumes', [PerfumeController::class, 'index'])->name('perfumes.index');

    Route::resource('perfumes', PerfumeController::class);



    // Dashboard protegido
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ----------------------------------
    // RUTAS DE PRODUCTOS (SOLO ADMINISTRADORES)
    // ----------------------------------


    // Rutas de productos
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::get('/productos/catalogo/{zona}', [ProductoController::class, 'catalogo'])->name('productos.catalogo');

    // Ruta de exportación de productos
    Route::get('/productos/export', function () {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    })->name('productos.export');





    // Rutas de ventas
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');

    // Descargar voucher de venta
    Route::get('/ventas/{id}/voucher', [VentaController::class, 'voucher'])->name('ventas.voucher');

    // Exportar ventas a Excel
    Route::get('ventas/exportar-excel', [VentaController::class, 'exportarVentasExcel'])->name('ventas.exportar.excel');




    Route::get('/ventas-credito', [VentaCreditoController::class, 'index'])->name('ventas_credito.index');
    Route::get('/ventas-credito/create', [VentaCreditoController::class, 'create'])->name('ventas_credito.create');
    Route::post('/ventas-credito', [VentaCreditoController::class, 'store'])->name('ventas_credito.store');
    Route::get('/ventas-credito/{id}', [VentaCreditoController::class, 'show'])->name('ventas_credito.show');
    Route::post('/ventas-credito/{id}/abonar', [VentaCreditoController::class, 'abonar'])->name('ventas_credito.abonar');




    Route::resource('compras', CompraController::class);





    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{user}/edit-password', [UserController::class, 'editPassword'])->name('usuarios.edit-password');
    Route::post('/usuarios/{user}/update-password', [UserController::class, 'updatePassword'])->name('usuarios.update-password');
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');




    Route::resource('dinerobanco', DinerobancoController::class);

    Route::get('/ventas/{venta}/boleta', [VentaController::class, 'descargarBoleta'])->name('ventas.boleta');


    Route::get('/perfumes/{perfume}', [PerfumeController::class, 'show'])->name('perfumes.show');
    Route::post('/perfumes', [PerfumeController::class, 'store'])->name('perfumes.store');
});