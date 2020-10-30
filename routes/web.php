<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return view('inicio');
});*/

Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

/*Employees*/
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('index');
Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::put('/employee', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');

/*Employees Require*/
Route::get('/require', [App\Http\Controllers\RequireEmployeeController::class, 'index'])->name('index');
Route::post('/require', [App\Http\Controllers\RequireEmployeeController::class, 'store'])->name('require.store');
Route::put('/require', [App\Http\Controllers\RequireEmployeeController::class, 'update'])->name('require.update');
Route::delete('/require', [App\Http\Controllers\RequireEmployeeController::class, 'destroy'])->name('require.destroy');

/*Categories*/
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('index');
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::put('/category', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::delete('/category', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');

/*Products*/
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::put('/product', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::delete('/product', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

/*Warehouses*/
/*Route::get('/warehouse', [App\Http\Controllers\WarehouseController::class, 'index'])->name('index');
Route::post('/warehouse', [App\Http\Controllers\WarehouseController::class, 'store'])->name('warehouse.store');
Route::put('/warehouse', [App\Http\Controllers\WarehouseController::class, 'update'])->name('warehouse.update');
Route::delete('/warehouse', [App\Http\Controllers\WarehouseController::class, 'destroy'])->name('warehouse.destroy');*/

/*TiposIva*/
Route::get('/iva', [App\Http\Controllers\TiposIvaController::class, 'index'])->name('index');
Route::post('/iva', [App\Http\Controllers\TiposIvaController::class, 'store'])->name('iva.store');
Route::put('/iva', [App\Http\Controllers\TiposIvaController::class, 'update'])->name('iva.update');
Route::delete('/iva', [App\Http\Controllers\TiposIvaController::class, 'destroy'])->name('iva.destroy');

/*Supplier*/
Route::get('/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('index');
Route::post('/supplier', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
Route::put('/supplier', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('supplier.destroy');

/*Orders*/
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
//Route::post('/order', [App\Http\Controllers\OrderController::class, 'saveOrder'])->name('order.saveOrder');
/*Route::put('/order', [App\Http\Controllers\OrderController::class, 'update'])->name('order.update');
Route::delete('/order', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');*/

/*Salida Productos*/
Route::get('/salidas', [App\Http\Controllers\SalidasProductoController::class, 'index'])->name('salidas.index');
Route::post('/salidas', [App\Http\Controllers\SalidasProductoController::class, 'store'])->name('salidas.store');
Route::put('/salidas', [App\Http\Controllers\SalidasProductoController::class, 'update'])->name('salidas.update');
Route::delete('/salidas', [App\Http\Controllers\SalidasProductoController::class, 'destroy'])->name('salidas.destroy');

/*Entrada Productos*/
Route::get('/entradas', [App\Http\Controllers\EntradasProductoController::class, 'index'])->name('index');

/*Stock*/
Route::get('/stock', [App\Http\Controllers\StockController::class, 'index'])->name('index');

/*Historial Ordenes*/
Route::get('/historial', [App\Http\Controllers\HistorialOrdenController::class, 'index'])->name('historial.index');
//Route::get('/historial/order/{id}', [App\Http\Controllers\HistorialOrdenController::class, 'show'])->name('descargarPDF');


// /*PDF orden de compra*/
// Route::get('/pdf', [App\Http\Controllers\PDFController::class, 'PDF'])->name('descargarPDF');

// /*Vista de repote PDF*/
// Route::get('/print', function () {
//     return view('orders.ordenpdf');
// });

// /*Vista de repote PDF version pagina*/
// Route::get('/test', function () {
//     return view('orders.test');
// });

//Route::get('/pdf', [App\Http\Controllers\PDFController::class, 'PDF'])->name('descargarPDF');
Route::get('/pdf/order/{id}', [App\Http\Controllers\PDFController::class, 'PDF'])->name('descargarPDF');

