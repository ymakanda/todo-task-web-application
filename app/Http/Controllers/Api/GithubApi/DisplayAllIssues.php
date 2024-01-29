<?php

namespace App\Http\Controllers\Api\GithubApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DisplayAllIssues extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $responce = Http::get('https://api.github.com/repos/ymakanda/todo-task-web-application/issues?state=all');
        
        if ($responce->status() == 200) {
            $data = $responce->json();

            return response()->view('api.github.all-opened-ssues', [
                'allOpenedIssues' => $data,
            ]);
        }

        return abort(500);
    }
}
