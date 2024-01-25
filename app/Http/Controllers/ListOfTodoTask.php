<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\TodoTaskList;
class ListOfTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->view('todo.list-of-todo-tasks', [
            'todoTaskList' => TodoTaskList::orderBy('updated_at', 'desc')->limit(10)->get(),
        ]);
    }
}
