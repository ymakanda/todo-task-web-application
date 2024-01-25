<?php

namespace App\Http\Controllers;

use \App\Models\User;
use \App\Models\UserTodoTaskList;
use \App\Models\TodoTaskList;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Arr;

class MyListOfTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $userTodoTaskListIds = UserTodoTaskList::select('todo_task_list_id')
            ->where('user_id', $user->id)
            ->get()
            ->toArray();

        $allMyTodoTask= TodoTaskList::whereIn('id', $userTodoTaskListIds)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        
        return response()->view('todo.my-list-of-todo-tasks', [
            'myTodoTaskList' => $allMyTodoTask
        ]);
    }
}
