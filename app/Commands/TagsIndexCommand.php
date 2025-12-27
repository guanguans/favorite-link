<?php

declare(strict_types=1);

namespace App\Commands;

use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\File;

final class TagsIndexCommand extends Command
{
    protected $signature = <<<'SIGNATURE'
        tags:index
        {--output=TAGS.md : Path to output file}
        {--data= : Path to the data file}
        {--sort= : Sort by (count|name) [default: count]}
        SIGNATURE;
    protected $description = 'Generate a tags index file grouped by tags';

    public function __construct(
        private readonly ProjectRepository $repository
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $outputPath = (string) $this->option('output');
        $dataPath = (string) $this->option('data');
        $sortBy = (string) $this->option('sort');

        $repository = $dataPath
            ? new ProjectRepository($dataPath)
            : $this->repository;

        $tagStats = $repository->getTagStats();

        if ($tagStats->isEmpty()) {
            $this->warn('No projects found. Add some projects first.');

            return self::FAILURE;
        }

        $content = $this->generateContent($repository, $tagStats, $sortBy);

        $outputFilePath = base_path($outputPath);
        File::put($outputFilePath, $content);

        $this->info("Tags index generated: {$outputPath}");
        $this->info("Total tags: {$tagStats->count()}");
        $this->info("Total projects: {$repository->count()}");

        return self::SUCCESS;
    }

    private function generateContent(ProjectRepository $repository, $tagStats, string $sortBy): string
    {
        $lines = [
            '# Tags Index',
            '',
            '> ❤️ 按标签分类的开源项目索引',
            '',
            '---',
            '',
            '## 统计摘要',
            '',
            sprintf('| 指标 | 数值 |'),
            sprintf('|------|------|'),
            sprintf('| 项目总数 | %d |', $repository->count()),
            sprintf('| 标签总数 | %d |', $tagStats->count()),
            '',
            '---',
            '',
            '## 标签目录',
            '',
        ];

        $sortedTags = match ($sortBy) {
            'name' => $tagStats->keys()->sort(),
            default => $tagStats->keys(),
        };

        foreach ($sortedTags as $tag) {
            $count = $tagStats[$tag];
            $lines[] = "- [{$tag}](#".strtolower($tag).") ({$count} 个项目)";
        }

        $lines[] = '';
        $lines[] = '---';
        $lines[] = '';

        foreach ($sortedTags as $tag) {
            $projects = $repository->getProjectsWithTag($tag);
            $count = $projects->count();

            $lines[] = "## {$tag}";
            $lines[] = '';
            $lines[] = "_{$count} 个项目_";
            $lines[] = '';
            $lines[] = '| 项目 | 描述 | 添加日期 |';
            $lines[] = '|------|------|---------|';

            foreach ($projects as $project) {
                $title = $this->escapeMarkdown($project['title']);
                $description = $this->escapeMarkdown($project['description']);
                $addedAt = $project['added_at'];
                $url = $project['url'];

                $lines[] = "| [{$title}]({$url}) | {$description} | {$addedAt} |";
            }

            $lines[] = '';
            $lines[] = '---';
            $lines[] = '';
        }

        $lines[] = '';
        $lines[] = '_Generated on '.now()->toDateString().'_';

        return implode("\n", $lines);
    }

    private function escapeMarkdown(string $text): string
    {
        return str_replace(
            ['|', '`', '*', '_', '[', ']', '(', ')'],
            ['&#124;', '&#96;', '&#42;', '&#95;', '&#91;', '&#93;', '&#40;', '&#41;'],
            $text
        );
    }
}
