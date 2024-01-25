<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{ Dashboard, ListOfTodoTask, MyListOfTodoTask };

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
});

require __DIR__.'/auth.php';
