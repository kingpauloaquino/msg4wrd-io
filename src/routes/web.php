<?php

use Illuminate\Support\Facades\Route;

Route::get('/msg4wrd-io', [KPAWork\MSG4wrdIO\Http\Controllers\MSG4wrdIOController::class, 'ShowStatus']);
Route::get('/msg4wrd-io/send-message/{mobile}', [KPAWork\MSG4wrdIO\Http\Controllers\MSG4wrdIOController::class, 'SampleMessage']);

