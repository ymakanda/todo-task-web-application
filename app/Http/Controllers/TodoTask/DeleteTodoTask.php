<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use \App\Models\TodoTaskList;

class DeleteTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function delete(Request $request, int $id): View
    {
        $todo = TodoTaskList::findOrFail($id);

        return view('todo.crud-todo.delete-todo-task-form', compact('todo'));
    }
    
    // public function destroy(Request $request, int $id): RedirectResponse
    // {
    //     $todo = TodoTaskList::findOrFail($id);

    //     $delete = $todo->delete($todo->id);

    //     if($delete) {
    //         session()->flash('notif.success', 'Todo task deleted successfully!');
    //         return redirect()->route('all-todo-task-list');
    //     }
    //     return abort(500);
    // }

     //Laravel's PDO (PHP Data Objects)
     public function destroy(Request $request, int $id): RedirectResponse
     {
         $updated_at = now();
         $deleted_at = now();
 
         $pdo = DB::connection()->getPdo();
 
        $results = $pdo->prepare("UPDATE todo_task_lists SET updated_at = NOW(), deleted_at = NOW() WHERE id = :id");
 
        $delete = $results->execute(['id' => $id]);
 
        if($delete) {
            session()->flash('notif.success', 'Todo task deleted successfully!');
            return redirect()->route('all-todo-task-list');
        }
 
        return abort(500);
     }
}
