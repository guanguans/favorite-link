<?php

declare(strict_types=1);

namespace App\Commands;

use App\Repositories\ProjectRepository;
use function Termwind\render;

final class RecommendCommand extends Command
{
    protected $signature = <<<'SIGNATURE'
        recommend
        {--tag= : Filter by specific tag}
        {--limit=10 : Maximum number of recommendations}
        {--data= : Path to the data file}
        {--json : Output in JSON format}
        SIGNATURE;
    protected $description = 'Randomly recommend projects based on tags';

    public function __construct(
        private readonly ProjectRepository $repository
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $tag = (string) $this->option('tag');
        $limit = (int) $this->option('limit');
        $dataPath = (string) $this->option('data');
        $outputJson = $this->option('json');

        $repository = $dataPath
            ? new ProjectRepository($dataPath)
            : $this->repository;

        $projects = $repository->all();

        if ($projects->isEmpty()) {
            $this->warn('No projects found. Add some projects first.');

            return self::FAILURE;
        }

        if ($tag) {
            $projects = $projects->filter(fn (array $p) => in_array($tag, $p['tags'] ?? [], true));
        }

        if ($projects->isEmpty()) {
            $this->warn("No projects found with tag: {$tag}");

            return self::FAILURE;
        }

        $recommendations = $repository->random($limit, $tag ? [$tag] : []);

        if ($outputJson) {
            $this->line(json_encode($recommendations->values()->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return self::SUCCESS;
        }

        $this->displayRecommendations($recommendations, $tag, $limit);

        return self::SUCCESS;
    }

    private function displayRecommendations($projects, ?string $tag, int $limit): void
    {
        $tagText = $tag ? "标签: <fg=cyan>{$tag}</>" : '全部标签';
        $this->info("🎯 推荐项目 ({$tagText}) - 共 {$projects->count()} 个");
        $this->newLine();

        $index = 1;
        foreach ($projects as $project) {
            $tags = implode(', ', $project['tags'] ?? []);
            $title = $project['title'];
            $url = $project['url'];
            $description = $project['description'];
            $addedAt = $project['added_at'];

            $html = <<<HTML
                <div class="mt-1">
                    <div class="flex space-x-1">
                        <span class="bg-green-300 text-black px-1">#{$index}</span>
                        <span class="text-gray">{$addedAt}</span>
                    </div>
                    <div class="ml-2 mt-1">
                        <a href="{$url}" class="text-blue-300 font-bold">{$title}</a>
                    </div>
                    <div class="ml-2 text-gray">
                        <span class="text-yellow-300">{$description}</span>
                    </div>
                    <div class="ml-2 text-gray">
                        <span class="text-cyan">Tags:</span> <span class="text-white">{$tags}</span>
                    </div>
                </div>
                HTML;

            render($html);
            $this->newLine();

            $index++;
        }

        $this->info("共推荐 {$projects->count()} 个项目");
    }
}
