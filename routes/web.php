<?php

use App\Http\Controllers\supplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseorderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|
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

Auth::routes();
Route::group(['middleware'=>['web', 'auth']], function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Unit Route
Route::get('/addunit', [UnitController::class, 'addUnit'])->name('addUnit');
Route::post('/addunit', [UnitController::class, 'addUnitPost'])->name('addUnitPost');
Route::get('/addunit/{id}', [UnitController::class, 'addUnit'])->name('updateUnit');
Route::post('/addUnitUpdate/{id}', [UnitController::class, 'addUnitPost'])->name('addUnitUpdate');
Route::get('/editunit', [UnitController::class, 'unitEdit'])->name('unitEdit');
    
//supplier Route
Route::get('/supplier', [supplierController::class, 'supplier'])->name('supplier');
Route::post('/supplierPost', [supplierController::class, 'supplierPost'])->name('supplierPost');
Route::get('/supplier/{id}', [supplierController::class, 'supplier'])->name('supplierEdit');
Route::post('/supplierPost/{id}', [supplierController::class, 'supplierPost'])->name('supplierPostUpdate');




//Purchase Route
Route::get('/purchase', [PurchaseController::class, 'purchase'])->name('purchase');
Route::post('/purchasePost', [PurchaseController::class, 'purchasePost'])->name('purchasePost');
Route::get('/purchase/{id}', [PurchaseController::class, 'purchase'])->name('purchaseEdit');
Route::post('/purchasePost/{id}', [PurchaseController::class, 'purchasePost'])->name('purchasePostUpdate');


//Purchase Order Route
Route::get('/purchaseorder', [PurchaseorderController::class, 'purchaseorder'])->name('purchaseorder');
Route::post('/purchaseorderPost', [PurchaseorderController::class, 'purchaseorderPost'])->name('purchaseorderPost');

});



