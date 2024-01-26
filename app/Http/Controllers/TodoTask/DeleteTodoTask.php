<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

use \App\Models\TodoTaskList;

class DeleteTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id): RedirectResponse
    {
        $todo = TodoTaskList::findOrFail($id);

        
        $delete = $todo->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Todo task deleted successfully!');
            return redirect()->route('all-todo-task-list');
        }

        return abort(500);
    }
}
