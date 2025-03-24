<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportesControllerAPI;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('reportes', ReportesControllerAPI::class);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsuarioApiController;

Route::apiResource('usuarios', UsuarioApiController::class);

