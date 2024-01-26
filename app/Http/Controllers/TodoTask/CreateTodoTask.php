<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\TodoTask\StoreRequest;
use \App\Models\TodoTaskList;


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
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $create = TodoTaskList::create($validated);

        if($create) {

            session()->flash('notif.success', 'Todo task created successfully!');
            return redirect()->route('all-todo-task-list');
        }

        return abort(500);
    }

}
