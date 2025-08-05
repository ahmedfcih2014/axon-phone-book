<?php

use App\Http\Controllers\PhoneNumbers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('phone-numbers.index');
});
Route::prefix('phone-numbers')
    ->as('phone-numbers.')
    ->controller(PhoneNumbers::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');
    });
