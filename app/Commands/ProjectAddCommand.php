<?php

declare(strict_types=1);

namespace App\Commands;

use App\Repositories\ProjectRepository;
use App\Services\TagExtractor;
use Illuminate\Support\Facades\File;

final class ProjectAddCommand extends Command
{
    protected $signature = <<<'SIGNATURE'
        project:add
        {url : The project URL}
        {title? : The project title}
        {--D|description= : The project description}
        {--T|tags= : Comma-separated tags, e.g. --tags="laravel,php,package"}
        {--data= : Path to the data file}
        SIGNATURE;
    protected $description = 'Add a new project with auto-tag extraction';

    public function __construct(
        private readonly ProjectRepository $repository,
        private readonly TagExtractor $tagExtractor
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $url = (string) $this->argument('url');
        $title = (string) ($this->argument('title') ?? '');
        $description = (string) $this->option('description');
        $tagsOption = (string) $this->option('tags');
        $dataPath = (string) $this->option('data');

        if (! $description && ! $title) {
            $this->error('Please provide either --description or title');

            return self::FAILURE;
        }

        $fullDescription = $description ?: $title;

        $manualTags = $tagsOption
            ? array_map('trim', explode(',', $tagsOption))
            : [];

        $tags = $this->tagExtractor->extract($fullDescription, $manualTags);

        $projectData = [
            'url' => $url,
            'title' => $title ?: $this->extractTitleFromUrl($url),
            'description' => $fullDescription,
            'tags' => $tags->toArray(),
            'added_at' => now()->toDateString(),
        ];

        $repository = $dataPath
            ? new ProjectRepository($dataPath)
            : $this->repository;

        if ($repository->findByUrl($url)) {
            $this->warn("Project already exists: {$url}");
            $this->info('Use project:update command to update it.');

            return self::FAILURE;
        }

        $repository->add($projectData);

        $this->info("Project added successfully!");
        $this->newLine();
        $this->line("  <fg=cyan>URL:</> {$url}");
        $this->line("  <fg=cyan>Title:</> {$projectData['title']}");
        $this->line("  <fg=cyan>Description:</> {$fullDescription}");
        $this->line("  <fg=cyan>Tags:</> {$tags->implode(', ')}");
        $this->line("  <fg=cyan>Added:</> {$projectData['added_at']}");
        $this->newLine();
        $this->info("Total projects: {$repository->count()}");

        return self::SUCCESS;
    }

    private function extractTitleFromUrl(string $url): string
    {
        if (preg_match('/github\.com\/([^\/]+)\/([^\/\?]+)/', $url, $matches)) {
            return $matches[2];
        }

        if (preg_match('/gitlab\.com\/([^\/]+)\/([^\/\?]+)/', $url, $matches)) {
            return $matches[2];
        }

        return basename(parse_url($url, PHP_URL_PATH));
    }
}
