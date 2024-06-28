<?php

namespace App\Services;

class GitHubService implements GitHubServiceInterface
{
    protected $token;

    public function __construct()
    {
        $this->token = env('GITHUB_TOKEN');
    }
    public function getIssues(string $owner, string $repo, string $state = null): array
    {
        $params = [
            'state'   => $state,
        ];
        $url = "https://api.github.com/repos/$owner/$repo/issues?". http_build_query($params);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Awesome-Octocat-App');
        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);

        $issues = json_decode($response, true);

        return $issues;
    }

    public function creatIssue($data): array
    {
        $url = "https://api.github.com/repos/$owner/$repo/issues?". http_build_query($data);

        $data = json_encode([
            'title' => $data['title'],
            'body' => $data['body'],
        ]);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Awesome-Octocat-App');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: token ' . $this->token
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);

        $issue = json_decode($response, true);

        return $issue;
    }
}
