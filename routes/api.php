<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsuarioApiController;

Route::apiResource('usuarios', UsuarioApiController::class);

