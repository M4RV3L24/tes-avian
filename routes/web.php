<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
})->name('form');


Route::get('/report', [CustomerController::class, 'report'])->name('reports');

Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {
    Route::post('insert', [PurchaseController::class, 'insert'])->name('create');
});
