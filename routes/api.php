<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/get_all_invoice', [InvoiceController::class, 'get_all_invoice']);
Route::get('/search_invoice', [InvoiceController::class, 'search_invoice']);
Route::get('/create_invoice', [InvoiceController::class, 'create_invoice']);
Route::get('/customers', [CustomerController::class, 'all_customers']);
Route::get('/products', [ProductController::class, 'all_products']);
Route::post('/add_invoice', [InvoiceController::class, 'add_invoice']);
Route::get('/show_invoice/{id}', [InvoiceController::class, 'show_invoice']);


