<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2018-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

use App\Commands\FeedCommand;

it('will throw an InvalidArgumentException', function (): void {
    $this->artisan(FeedCommand::class, ['--from' => 'README.rs'])->assertOk();
})->group(__DIR__, __FILE__)->throws(\Symfony\Component\Console\Exception\InvalidArgumentException::class);

it('can generate feed', function (): void {
    $this->artisan(FeedCommand::class)->assertOk();
    $this->artisan(FeedCommand::class, ['--from' => fixtures_path('README.md')])->assertOk();
})->group(__DIR__, __FILE__);
