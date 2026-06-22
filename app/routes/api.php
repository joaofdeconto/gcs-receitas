<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'env'    => config('app.env'),
        'time'   => now()->toDateTimeString(),
    ]);
});
