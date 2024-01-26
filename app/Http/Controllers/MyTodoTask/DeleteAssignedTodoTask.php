<?php

namespace App\Http\Controllers\MyTodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use \App\Models\UserTodoTaskList;

class DeleteAssignedTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id): RedirectResponse
    {
        $user = Auth::user();
        $todo = UserTodoTaskList::where('user_id', $user->id)->where('todo_task_list_id', $id)->first();

        
        $delete = $todo->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Todo task deleted successfully!');
            return redirect()->route('all-my-todo-task');
        }

        return abort(500);
    }
}
