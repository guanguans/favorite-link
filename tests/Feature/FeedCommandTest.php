<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2018-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

use App\Commands\FeedCommand;
use Laminas\Feed\Writer\Exception\InvalidArgumentException;

it('will throw an InvalidArgumentException of Symfony', function (): void {
    $this->artisan(FeedCommand::class, ['--from' => fake()->filePath()])->assertFailed();
})->group(__DIR__, __FILE__);

it('will throw an InvalidArgumentException of Laminas', function (): void {
    $this->artisan(FeedCommand::class, ['--from' => fixtures_path('README.md')])->assertOk();
})->group(__DIR__, __FILE__)->throws(InvalidArgumentException::class);

it('can generate feed', function (): void {
    $this->artisan(FeedCommand::class)->assertOk();
})->group(__DIR__, __FILE__);
