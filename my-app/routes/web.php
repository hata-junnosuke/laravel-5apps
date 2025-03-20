<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{id}', [TaskController::class, 'maskAsDeleted'])->name('tasks.maskAsDeleted');
Route::get('/tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');
Route::put('/tasks/{id}/recover', [TaskController::class, 'recover'])->name('tasks.recover');
Route::delete('/tasks/deleteTrash', [TaskController::class, 'deleteTrash'])->name('tasks.deleteTrash');