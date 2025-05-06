<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MaintenanceRequestController;

Route::get('/',function () {
    return redirect()->route('requests.index');
});

Route::resource('requests', MaintenanceRequestController::class);

Route::get('/debug-key', function () {
    return [
        'env' => env('APP_KEY'),
        'config' => config('app.key'),
    ];
});

require __DIR__.'/auth.php';