<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\TodoTask\UpdateRequest;
use \App\Models\TodoTaskList;

class UpdateTodoTask extends Controller
{
    public function edit(string $id): Response
    {
        return response()->view('todo.crud-todo.form', [
            'todoTask' => TodoTaskList::findOrFail($id),
        ]);
    }

    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $todo = TodoTaskList::findOrFail($id);
        $validated = $request->validated();

        $update = $todo->update($validated);

        if($update) {
            session()->flash('notif.success', 'Todo task updated successfully!');
            return redirect()->route('all-todo-task-list');
        }

        return abort(500);
    }
}
