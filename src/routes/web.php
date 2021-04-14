<?php

use Illuminate\Support\Facades\Route;

Route::get('/msg4wrd-io', [KPAWork\MSG4wrdIO\Http\Controllers\SampleController::class, 'ShowStatus']);
Route::get('/msg4wrd-io/send-message', [KPAWork\MSG4wrdIO\Http\Controllers\SampleController::class, 'Demo']);

