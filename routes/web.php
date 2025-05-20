<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');


Route::get('/', [TaskController::class, 'index']);
Route::resource('tasks', TaskController::class);
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');

