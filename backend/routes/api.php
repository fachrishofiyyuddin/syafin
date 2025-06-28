<?php

use App\Http\Controllers\Api\TelegramController;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Route;


Route::post('/webhook/telegram', [TelegramController::class, 'webhook']);
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);
