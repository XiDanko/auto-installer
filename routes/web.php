<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/laravel-websockets/start', function () {
    Artisan::call('websockets:serve', ['--disable-statistics' => true, '-q' => true]);
})->name('websockets.start');


