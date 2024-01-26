<?php

namespace App\Http\Controllers\TodoTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use \App\Models\TodoTaskList;

class ViewTodoTask extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        return response()->view('todo.crud-todo.show', [
            'todoTask' => TodoTaskList::findOrFail($id),
        ]);
    }

}
