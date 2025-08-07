<?php

/** @noinspection PhpUndefinedMethodInspection */
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

use App\Commands\Command;
use App\Commands\FeedCommand;

arch()->preset()->php();
arch()->preset()->security();
// arch()->preset()->laravel();
// arch()->preset()->strict()->ignoring([
//     Command::class,
//     FeedCommand::class,
// ]);
// arch()->preset()->relaxed();

arch('will not use debugging functions')
    ->group(__DIR__, __FILE__)
    // ->skip()
    ->expect([
        'echo',
        'print',
        'die',
        'exit',
        'printf',
        'vprintf',
        'var_dump',
        'dump',
        'dd',
        'ray',
        'print_r',
        'var_export',
    ])
    ->each->not->toBeUsed();
