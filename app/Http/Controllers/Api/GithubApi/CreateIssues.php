<?php

namespace App\Http\Controllers\Api\GithubApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Api\Github\CreateIssueRequest;

class CreateIssues extends Controller
{
    public function create()
    {
        return response()->view('api.github.create-issues');
    }

    public function store(CreateIssueRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        
        $responce = Http::withToken(env('GITHUB_TOKEN'))->post('https://api.github.com/repos/ymakanda/todo-task-web-application/issues' , $validatedData);

        if ($responce->status() == 201) {
            session()->flash('notif.success', 'Issue created successfully!');
            return redirect()->route('all-issues');
        }

        return abort(500);
    }
        
}