<?php

namespace App\Http\Controllers\MyTodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use \App\Models\User;
use \App\Models\TodoTaskList;
use \App\Models\UserTodoTaskList;

use App\Http\Requests\TodoTask\AssignTodoRequest;


class AssignTodoTask extends Controller
{
    public function create()
    {

        $allTodoTask = TodoTaskList::orderBy('title', 'desc')->get();
        $allUsers = User::orderBy('name', 'desc')->get();
        
        return response()->view('todo.crud-my-todo.form', ['allTodoTask' =>$allTodoTask, 'allUsers' => $allUsers] );
    }

    public function store(AssignTodoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = UserTodoTaskList::create($validated);

        if($create) {

            session()->flash('notif.success', 'Todo task created successfully!');
            return redirect()->route('all-my-todo-task');
        }

        return abort(500);
    }
}
