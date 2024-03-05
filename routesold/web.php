<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('new-task', [TaskController::class, 'new_task'])->name('new-task');
Route::post('new-task', [TaskController::class, 'new_task_post'])->name('kaamdekh.create');
Route::get('kaamdekh-list', [TaskController::class, 'kaamdekh_list_filters'])->name('kaamdekh-list');
Route::get('/kaamdekh-task-view/{task_id}', [TaskController::class, 'task_view_edit']);
Route::post('update-task', [TaskController::class, 'update_task'])->name('kaamdekh.update');
Route::get('test', [TaskController::class, 'test']);


