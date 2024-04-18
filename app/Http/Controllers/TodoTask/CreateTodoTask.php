<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\TodoTask\StoreRequest;
use \App\Models\TodoTaskList;
use DB;

class CreateTodoTask extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {

        return response()->view('todo.crud-todo.form');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreRequest $request): RedirectResponse
    // {
    //     $validated = $request->validated();

    //     $create = TodoTaskList::create($validated);

    //     if($create) {

    //         session()->flash('notif.success', 'Todo task created successfully!');
    //         return redirect()->route('all-todo-task-list');
    //     }

    //     return abort(500);
    // }


    //PDO version

    public function store(Request $request)
    {
        $data = $request->all(); // Retrieve data from the request

        $pdo = DB::connection()->getPdo(); // Connect to the database using PDO
        $created_at = now();// Manually specify timestamps
        $updated_at = now();
        // Prepare the SQL statement
        $statement = $pdo->prepare("INSERT INTO todo_task_lists (title, description, comments, created_at, updated_at) 
                                    VALUES (:title, :description, :comments, :created_at, :updated_at)");
        
        // Bind parameters
        $statement->bindParam(':title', $data['title']);
        $statement->bindParam(':description', $data['description']);
        $statement->bindParam(':comments', $data['comments']);
        $statement->bindParam(':created_at', $created_at);
        $statement->bindParam(':updated_at', $updated_at);

        // Execute the statement
        $statement->execute();

        $lastInsertedId = $pdo->lastInsertId(); // Optionally, retrieve the last inserted ID

        // Optionally, return a response
        if($lastInsertedId) {
            session()->flash('notif.success', 'Todo task created successfully!');

            return redirect()->route('all-todo-task-list');
        }

        return abort(500);
    }

}
