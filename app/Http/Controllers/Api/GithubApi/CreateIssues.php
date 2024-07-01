<?php

namespace App\Http\Controllers\Api\GithubApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Api\Github\CreateIssueRequest;
use App\Services\GitHubServiceInterface;

class CreateIssues extends Controller
{
    protected $gitHubService;

    public function __construct(GitHubServiceInterface $gitHubService)
    {
        $this->gitHubService = $gitHubService;
    }
    public function create()
    {
        return response()->view('api.github.create-issues');
    }
    
    public function store(CreateIssueRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $owner = 'ymakanda';
        $repo = 'todo-task-web-application';
        try {
            $issue = $this->gitHubService->createIssue($owner, $repo, $validatedData);
            session()->flash('notif.success', 'Issue created successfully!');
            
            return redirect()->route('all-issues');
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}