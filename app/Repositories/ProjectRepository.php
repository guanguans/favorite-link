<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

final class ProjectRepository
{
    private const string DATA_FILE = 'data/projects.json';

    public function __construct(
        private readonly string $dataPath = ''
    ) {}

    public function all(): Collection
    {
        if (! File::exists($this->getDataFilePath())) {
            return collect();
        }

        $content = File::get($this->getDataFilePath());
        $data = json_decode($content, true);

        return collect($data ?? []);
    }

    public function findByUrl(string $url): ?array
    {
        return $this->all()->firstWhere('url', $url);
    }

    public function findByTag(string $tag): Collection
    {
        return $this->all()->filter(fn (array $project) => in_array($tag, $project['tags'] ?? [], true));
    }

    public function findByTags(array $tags): Collection
    {
        return $this->all()->filter(fn (array $project) => !empty(array_intersect($tags, $project['tags'] ?? [])));
    }

    public function add(array $project): self
    {
        $projects = $this->all();
        $projects->push([
            'url' => $project['url'],
            'title' => $project['title'],
            'description' => $project['description'],
            'tags' => $project['tags'] ?? [],
            'added_at' => $project['added_at'] ?? now()->toDateString(),
        ]);

        $this->save($projects);

        return $this;
    }

    public function update(string $url, array $data): self
    {
        $projects = $this->all();
        $index = $projects->search(fn (array $project) => $project['url'] === $url);

        if ($index !== false) {
            $projects[$index] = array_merge($projects[$index]->toArray(), $data);
            $this->save($projects);
        }

        return $this;
    }

    public function remove(string $url): self
    {
        $projects = $this->all()->reject(fn (array $project) => $project['url'] === $url);
        $this->save($projects);

        return $this;
    }

    public function getTags(): Collection
    {
        return $this->all()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->sort()
            ->values();
    }

    public function getProjectsByTag(): Collection
    {
        return $this->all()->groupBy(fn (array $project) => implode(',', $project['tags'] ?? []));
    }

    public function getTagStats(): Collection
    {
        $stats = [];

        foreach ($this->all() as $project) {
            foreach ($project['tags'] ?? [] as $tag) {
                $stats[$tag] = ($stats[$tag] ?? 0) + 1;
            }
        }

        return collect($stats)->sortDesc();
    }

    public function getProjectsWithTag(string $tag): Collection
    {
        return $this->all()
            ->filter(fn (array $project) => in_array($tag, $project['tags'] ?? [], true))
            ->sortByDesc('added_at');
    }

    public function random(int $limit, array $tags = []): Collection
    {
        $projects = $tags ? $this->findByTags($tags) : $this->all();

        return $projects->random(min($limit, $projects->count()));
    }

    public function count(): int
    {
        return $this->all()->count();
    }

    private function getDataFilePath(): string
    {
        return $this->dataPath ?: base_path(self::DATA_FILE);
    }

    private function save(Collection $projects): void
    {
        $directory = dirname($this->getDataFilePath());

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put(
            $this->getDataFilePath(),
            json_encode($projects->values()->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}
