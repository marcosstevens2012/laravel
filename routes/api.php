<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AutoController;

Route::get('/home', function () {
    return response()->json([
        'message' => 'Hello World!',
        'status' => 'success',
        'timestamp' => now(),
        'endpoint' => '/home'
    ]);
});

Route::apiResource('examples', ExampleController::class);

// Rutas para Marcas
Route::prefix('marcas')->group(function () {
    Route::get('/', [MarcaController::class, 'index']);
    Route::post('/', [MarcaController::class, 'store']);
    Route::get('/{marca}', [MarcaController::class, 'show']);
    Route::put('/{marca}', [MarcaController::class, 'update']);
    Route::delete('/{marca}', [MarcaController::class, 'destroy']);
    Route::get('/{marca}/autos', [MarcaController::class, 'autos']);
});

// Rutas para Autos
Route::prefix('autos')->group(function () {
    Route::get('/', [AutoController::class, 'index']);
    Route::post('/', [AutoController::class, 'store']);
    Route::get('/{auto}', [AutoController::class, 'show']);
    Route::put('/{auto}', [AutoController::class, 'update']);
    Route::delete('/{auto}', [AutoController::class, 'destroy']);
    Route::get('/marca/{marca}', [AutoController::class, 'porMarca']);
    Route::get('/filtros/precio', [AutoController::class, 'porPrecio']);
    Route::get('/filtros/anio', [AutoController::class, 'porAnio']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
