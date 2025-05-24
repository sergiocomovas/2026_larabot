<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;

Route::get('/', function () {
    return view('welcome');
});

//APIS TEST CAMBIO
Route::apiResource('api/pruebas', PruebaController::class);