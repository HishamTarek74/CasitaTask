<?php

use App\Http\Controllers\API\MapController;
use Illuminate\Support\Facades\Route;


Route::get('addresses', [MapController::class, 'getAddresses'])->name('maps.index');
