<?php

namespace App\Http\Controllers\Api\GithubApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\GitHubServiceInterface;

class DisplayAllOpenedIssues extends Controller
{
    protected $gitHubService;

    public function __construct(GitHubServiceInterface $gitHubService)
    {
        $this->gitHubService = $gitHubService;
    }

    public function __invoke(Request $request)
    {
        $owner = 'ymakanda';
        $repo = 'todo-task-web-application';
        try {
            $data = $this->gitHubService->getIssues($owner, $repo, $state = 'open');
            return response()->view('api.github.all-opened-ssues', ['allOpenedIssues' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    // public function __invoke(Request $request)
    // {
    //     $responce = Http::get('https://api.github.com/repos/ymakanda/todo-task-web-application/issues');
        
    //     if ($responce->status() == 200) {
    //         $data = $responce->json();

    //         return response()->view('api.github.all-opened-ssues', [
    //             'allOpenedIssues' => $data,
    //         ]);
    //     }

    //     return abort(500);
    // }
    
}
