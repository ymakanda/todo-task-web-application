<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoTask\UpdateRequest;
use \App\Models\TodoTaskList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UpdateTodoTask extends Controller
{
    public function edit(string $id): Response
    {
        return response()->view('todo.crud-todo.form', [
            'todoTask' => TodoTaskList::findOrFail($id),
        ]);
    }

    // public function update(UpdateRequest $request, string $id): RedirectResponse
    // {
    //     $todo = TodoTaskList::findOrFail($id);
    //     $validated = $request->validated();

    //     $update = $todo->update($validated);

    //     if($update) {
    //         session()->flash('notif.success', 'Todo task updated successfully!');
    //         return redirect()->route('all-todo-task-list');
    //     }

    //     return abort(500);
    // }

    //Laravel's PDO (PHP Data Objects)
    public function update(Request $request, int $id): RedirectResponse
    {   
        $data = $request->all();
        $updated_at = now();

        $pdo = DB::connection()->getPdo();

        $results = $pdo->prepare("SELECT * FROM todo_task_lists WHERE title = :title");

        $results->execute(['title' => $request->title]);

        $foundTitle = $results->fetch($pdo::FETCH_ASSOC);

        if($foundTitle) {
             $statement = $pdo->prepare("UPDATE todo_task_lists SET description = :description, comments = :comments, updated_at = :updated_at  WHERE  id = :id");

            $statement->bindParam(':description', $data['description']);
            $statement->bindParam(':comments', $data['comments']);
            $statement->bindParam(':updated_at', $updated_at);
            $statement->bindParam(':id', $id);

            $update = $statement->execute();
            if($update) {
                session()->flash('notif.success', 'Todo task updated successfully!');
                return redirect()->route('all-todo-task-list');
            }

        } else {
            $statement = $pdo->prepare("UPDATE todo_task_lists SET title = :title, description = :description, comments = :comments, updated_at = :updated_at  WHERE  id = :id");

            $statement->bindParam(':title', $data['title']);
            $statement->bindParam(':description', $data['description']);
            $statement->bindParam(':comments', $data['comments']);
            $statement->bindParam(':updated_at', $updated_at);
            $statement->bindParam(':id', $id);

            $update = $statement->execute();
            if($update) {
                session()->flash('notif.success', 'Todo task updated successfully!');
                return redirect()->route('all-todo-task-list');
            }
        }

        return abort(500);
    }
}
