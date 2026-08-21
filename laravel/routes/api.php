<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemoController;
use Illuminate\Support\Facades\Route;

Route::post('/memos', [MemoController::class, 'store']);
Route::get('/memos', [MemoController::class, 'index']);
Route::delete('/memos/{id}', [MemoController::class, 'destroy']);
Route::put('/memos/{id}', [MemoController::class, 'update']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
