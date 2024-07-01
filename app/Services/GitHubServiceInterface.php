<?php

namespace App\Services;

interface GitHubServiceInterface
{
    public function getIssues(string $owner, string $repo, string $state): array;
    public function createIssue(string $owner, string $repo, array $data): array;
}
