<?php

namespace App\Services;

interface GitHubServiceInterface
{
    public function getIssues(string $owner, string $repo, string $state): array;
}
