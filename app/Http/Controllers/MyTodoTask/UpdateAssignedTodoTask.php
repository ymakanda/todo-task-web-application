<?php

namespace App\Http\Controllers\MyTodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\TodoTaskList;
use \App\Models\UserTodoTaskList;

use App\Http\Requests\TodoTask\AssignTodoRequest;

class UpdateAssignedTodoTask extends Controller
{
    public function edit(string $id): Response
    {
        $user = Auth::user();
        $allTodoTask = TodoTaskList::orderBy('title', 'desc')->get();
        
        $allUsers = User::orderBy('name', 'desc')->get();
        
        $todoTask = UserTodoTaskList::where('user_id', $user->id)->where('todo_task_list_id', $id)->first();
        
        return response()->view('todo.crud-my-todo.form', [
            'todoTask' => $todoTask, 'allTodoTask' =>$allTodoTask, 'allUsers' => $allUsers,
        ]);
    }

    public function update(AssignTodoRequest $request, string $id): RedirectResponse
    {
        $user = Auth::user();
        $todo = UserTodoTaskList::where('user_id', $user->id)->where('todo_task_list_id', $id)->first();
        $validated = $request->validated();
        $update = $todo->update($validated);

        if($update) {
            session()->flash('notif.success', 'Todo task updated successfully!');
            return redirect()->route('todo.crud-my-todo.form');
        }

        return abort(500);
    }
}
