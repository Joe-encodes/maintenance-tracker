<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MaintenanceRequestController;

Route::get('/',function () {
    return redirect()->route('requests.index');
});

Route::resource('requests', MaintenanceRequestController::class);

require __DIR__.'/auth.php';