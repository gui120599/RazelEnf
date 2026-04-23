<?php

use App\Http\Controllers\EventoAdversoPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('h/{tenant:slug}')->group(function () {
    Route::get('/evento-adverso', [EventoAdversoPublicController::class, 'create']);
    Route::post('/evento-adverso', [EventoAdversoPublicController::class, 'store'])
        ->middleware('throttle:10,1'); // 10 tentativas por minuto
});
