<?php

use App\Http\Controllers\TranslateController;
use Illuminate\Support\Facades\Route;

Route::post('/translate', [TranslateController::class, 'translate'])
    ->name('api.translate');

