<?php


use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SupplierController;

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

Route::group(['middleware' => ['auth']], function () {

    Route::get('index', [App\Http\Controllers\Backend\UserController::class, 'index'])
        ->name('admin.index');

//    Route::get('/about-us', 'Frontend\FrontendController@aboutUs')->name('about.us');

    /*Route::prefix('users')->group(function () {
        Route::get('view', 'Backend\UserController@view')->name('users.view')->middleware('test');
        Route::get('add', 'Backend\UserController@add')->name('users.add');
        Route::post('store', 'Backend\UserController@store')->name('users.store');
        Route::get('edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('delete/{id}', 'Backend\UserController@delete')->name('users.delete');
    });

    Route::prefix('logos')->group(function () {
        Route::get('view', 'Backend\LogoController@view')->name('logos.view');
        Route::get('add', 'Backend\LogoController@add')->name('logos.add');
        Route::post('store', 'Backend\LogoController@store')->name('logos.store');
        Route::get('edit/{id}', 'Backend\LogoController@edit')->name('logos.edit');
        Route::post('update/{id}', 'Backend\LogoController@update')->name('logos.update');
        Route::get('delete/{id}', 'Backend\LogoController@delete')->name('logos.delete');
    });

    Route::prefix('profiles')->group(function () {
        Route::get('view', 'Backend\ProfileController@view')->name('profiles.view');
        Route::get('edit/{id}', 'Backend\ProfileController@edit')->name('profiles.edit');
        Route::post('update/{id}', 'Backend\ProfileController@update')->name('profiles.update');
        Route::get('password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
        Route::post('password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
    });*/



    Route::resource('suppliers', SupplierController::class);

    Route::get('suppliers/{id}/delete', [SupplierController::class, 'delete'])->name('suppliers.delete');

    Route::prefix('customers')->group(function(){
        Route::get('', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('store', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::post('update/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::get('delete/{id}', [CustomerController::class, 'destroy'])->name('customers.delete');
    });
    Route::prefix('units')->group(function(){
        Route::get('', [UnitController::class, 'index'])->name('units.index');
        Route::get('create', [UnitController::class, 'create'])->name('units.create');
        Route::post('store', [UnitController::class, 'store'])->name('units.store');
        Route::get('edit/{id}', [UnitController::class, 'edit'])->name('units.edit');
        Route::post('update/{id}', [UnitController::class, 'update'])->name('units.update');
        Route::get('delete/{id}', [UnitController::class, 'destroy'])->name('units.delete');
    });

    Route::prefix('categories')->group(function(){
        Route::get('', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    });
    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class,'index'])->name('products.index');
        Route::get('add', [ProductController::class,'create'])->name('products.add');
        Route::post('store', [ProductController::class,'store'])->name('products.store');
        Route::get('edit/{id}', [ProductController::class,'edit'])->name('products.edit');
        Route::post('update/{id}', [ProductController::class,'update'])->name('products.update');
        Route::get('delete/{id}', [ProductController::class,'delete'])->name('products.delete');
    });
    Route::prefix('purchases')->group(function () {
        Route::get('', [PurchaseController::class,'index'])->name('purchases.index');
        Route::get('add', [PurchaseController::class,'create'])->name('purchases.add');
        Route::post('store', [PurchaseController::class,'store'])->name('purchases.store');
        Route::get('edit/{id}', [PurchaseController::class,'edit'])->name('purchases.edit');
        Route::get('pending', [PurchaseController::class,'pendingList'])->name('purchases.pending.list');
        Route::post('update/{id}', [PurchaseController::class,'update'])->name('purchases.update');
        Route::get('approve/{id}', [PurchaseController::class,'approve'])->name('purchases.approve');
        Route::get('delete/{id}', [PurchaseController::class,'delete'])->name('purchases.delete');
    });

    Route::get('get-category', [\App\Http\Controllers\Backend\DefaultController::class, 'getCategory'])->name('get.category');
    Route::get('get-product', [\App\Http\Controllers\Backend\DefaultController::class, 'getProduct'])->name('get.product');
    Route::get('get-stock', [\App\Http\Controllers\Backend\DefaultController::class, 'getStock'])->name('check.product.stock');

    Route::prefix('invoice')->group(function () {
        Route::get('', [InvoiceController::class,'index'])->name('invoice.index');
        Route::get('add', [InvoiceController::class,'create'])->name('invoice.add');
        Route::post('store', [InvoiceController::class,'store'])->name('invoice.store');
        Route::get('edit/{id}', [InvoiceController::class,'edit'])->name('invoice.edit');
        Route::get('pending', [InvoiceController::class,'pendingList'])->name('invoice.pending.list');
        Route::post('update/{id}', [InvoiceController::class,'update'])->name('invoice.update');
        Route::get('approve/{id}', [InvoiceController::class,'approve'])->name('invoice.approve');
        Route::get('delete/{id}', [InvoiceController::class,'delete'])->name('invoice.delete');
        Route::post('approve/store/{id}', [InvoiceController::class,'approvalStore'])->name('approval.store');
        Route::get('print/list', [InvoiceController::class,'printInvoiceList'])->name('invoice.print.list');
        Route::get('print/{id}', [InvoiceController::class,'printInvoice'])->name('invoice.print');
        Route::get('daily/report', [InvoiceController::class,'dailyReport'])->name('invoice.daily.report');
        Route::get('daily/report/pdf', [InvoiceController::class,'dailyReportPdf'])->name('daily.invoice.report.pdf');
    });
    Route::prefix('stocks')->group(function () {
        Route::get('', [StockController::class,'stockReport'])->name('stocks.report');
        Route::get('report/pdf', [StockController::class,'stockReportPdf'])->name('stocks.report.pdf');
        Route::get('report/supplier/product/wise', [StockController::class,'supplierProductWise'])->name('stocks.report.supplier.product.wise');
    });

});


