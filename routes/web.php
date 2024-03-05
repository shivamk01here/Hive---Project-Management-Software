<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\custom_authController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\sprintController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\notesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('home', [taskController::class, 'welcome']);
Route::get('dashboard', [taskController::class, 'welcome'])->name('dashboard');  
Route::get('login', [custom_authController::class, 'index'])->name('login');
Route::post('custom-login', [custom_authController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [custom_authController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [custom_authController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [custom_authController::class, 'signOut'])->name('signout');
Route::get('logout', [custom_authController::class, 'signOut'])->name('logout');
Route::get('/geturlfetch/{id}', [custom_authController::class, 'geturlfetch'])->name('geturlfetch');

Route::get('new-task', [taskController::class, 'new_task'])->name('new-task');
Route::post('new-task', [taskController::class, 'new_task_post'])->name('kaamdekh.create');

Route::get('task-list', [taskController::class, 'kaamdekh_list_filters'])->name('tasklist');

Route::post('update-task', [taskController::class, 'update_task'])->name('kaamdekh.update');
Route::post('/comment/add', [taskController::class, 'add_comment'])->name('add_comment');
Route::get('my-task', [taskController::class, 'my_task'])->name('my-task'); 


Route::get('/add-subtask-view/{task_id?}', [taskController::class, 'add_subtask_view'])->name('add-subtask-view');
Route::post('/add-subtask-post', [taskController::class, 'post_add_subtask'])->name('post-add-subtask');
Route::post('/task-completed', [taskController::class, 'task-completed'])->name('task-completed');
Route::get('/download-tasks', 'taskController@downloadTasks')->name('downloadTasks');
Route::get('/download-csv', 'CsvExportController@downloadCsv')->name('download-csv');
Route::get('/view-parent-task/{parent_task_id?}',  [taskController::class, 'view_parent_task'])->name('view-parent-task');
Route::get('/sprint',  [sprintController::class, 'sprint'])->name('sprint-view');
Route::get('/sprintlisting',  [sprintController::class, 'sprintlisting'])->name('sprintlisting');
Route::post('/sprintcreate',  [sprintController::class, 'sprintcreate'])->name('sprintcreate');


Route::get('/view-task-history/{task_id?}', [taskController::class, 'view_task_history'])->name('view-task-history');
Route::get('/view-parent-task/{parent_task_id?}',  [taskController::class, 'view_parent_task'])->name('view-parent-task');
Route::get('/view-subtasks/{task_id?}', [taskController::class, 'view_subtasks'])->name('view-subtasks');
Route::get('/view-subtasks/{task_id?}', [taskController::class, 'view_subtasks'])->name('view-subtasks');
Route::get('/re-activate-task/{task_id}', [taskController::class, 're_activate_task'])->name('re-activate-task');
Route::get('/completion-mail/{task_id}', [taskController::class, 'completion_mail'])->name('completion-mail');

Route::get('/review-request/{task_id?}',  [taskController::class, 'review_request'])->name('review-request');


//------------------------------------admin Routes--------------------------------------

Route::get('/admin-home', [admincontroller::class, 'admin_home'])->name('admin-home');
Route::post('sprint-mail', [admincontroller::class,'sprint_mail'])->name('sprint-mail');


//--------------------------------Middleware for visibility------------------
Route::middleware(['authorize_task_view'])->group(function () {
    Route::get('/task-view/{task_id}', [TaskController::class, 'task_view_edit'])->name('view');
    Route::get('/view-task/{task_id?}', [taskController::class, 'view_task'])->name('view-task');
});

Route::get('/task-visibility', [taskcontroller::class, 'task_visibility'])->name('task-visibility');


//------------------------------------drag and drop for changing status ----------------------------
Route::get('drag-n-drop', [taskcontroller::class,'drag_n_drop'])->name('drag-n-drop');
Route::post('update-task-stage', [taskController::class, 'update_task_stage'])->name('update-task-stage');


//------------------------------------notes----------------------------
Route::get('my-notes', [notesController::class,'notes_listing'])->name('my-notes');
       //-------------------to save new note in db ==========
Route::post('save-note', [notesController::class, 'save_note'])->name('save-note');
      //-------to archieve the note --------------
Route::post('archive-note', [notesController::class, 'archive_note'])->name('archive-note');
      //---to fetch note to update----------------
Route::get('get-note', [notesController::class,'get_note'])->name('get-note');
     //------to update note after edit-------
Route::post('update-note', [notesController::class, 'update_note'])->name('update-note');




