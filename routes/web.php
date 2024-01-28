<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{ Dashboard, ListOfTodoTask, MyListOfTodoTask };
use App\Http\Controllers\TodoTask\{ CreateTodoTask, UpdateTodoTask, ViewTodoTask, DeleteTodoTask };
use App\Http\Controllers\MyTodoTask\{ AssignTodoTask, UpdateAssignedTodoTask, DeleteAssignedTodoTask};

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Todo task
    Route::get('/all-my-todo-task', MyListOfTodoTask::class)->name('all-my-todo-task');
    Route::get('/all-todo-task-list', ListOfTodoTask::class)->name('all-todo-task-list');
    Route::get('/todo-task', [CreateTodoTask::class, 'create'])->name('create-todo');
    Route::post('/todo-task', [CreateTodoTask::class, 'store'])->name('store-todo');
    Route::get('/todo-task/{id}', [UpdateTodoTask::class, 'edit'])->name('edit-todo');
    Route::put('/todo-task/{id}', [UpdateTodoTask::class, 'update'])->name('update-todo');
    Route::get('/todo-task/show/{id}', ViewTodoTask::class)->name('view-todo');
    Route::delete('/todo-task/delete/todo/{id}', DeleteTodoTask::class)->name('delete-todo');

    //My todo task
    Route::get('/my-todo-task', [AssignTodoTask::class, 'create'])->name('create-my-todo');
    Route::post('/my-todo-task', [AssignTodoTask::class, 'store'])->name('store-my-todo');
    Route::get('/my-todo-task/{id}', [UpdateAssignedTodoTask::class, 'edit'])->name('edit-my-todo');
    Route::get('/my-todo-task/update{id}', [UpdateAssignedTodoTask::class, 'update'])->name('update-my-todo');
    Route::delete('/todo-task/delete/my-todo/{id}', DeleteAssignedTodoTask::class)->name('delete-my-todo');

});

require __DIR__.'/auth.php';
