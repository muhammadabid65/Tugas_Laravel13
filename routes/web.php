<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Resource route ini otomatis mencakup index, create, store, show, edit, update, destroy
Route::resource('products', ProductController::class);