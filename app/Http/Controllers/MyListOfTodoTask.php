<?php

namespace App\Http\Controllers;

use \App\Models\User;
use \App\Models\UserTodoTaskList;
use \App\Models\TodoTaskList;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MyListOfTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $allMyTodoTask = $user->todoTaskList;
        
        return response()->view('todo.my-list-of-todo-tasks', [
            'myTodoTaskList' => $allMyTodoTask
        ]);
    }
}
