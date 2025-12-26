<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\ProjectRepository;
use App\Services\TagExtractor;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void {}

    #[\Override]
    public function register(): void
    {
        $this->app->singleton(TagExtractor::class, fn () => new TagExtractor);

        $this->app->singleton(ProjectRepository::class, function ($app) {
            $dataPath = base_path('data/projects.json');

            return new ProjectRepository($dataPath);
        });
    }
}
