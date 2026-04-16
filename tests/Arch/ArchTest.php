<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2018-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

use App\Commands\InspireCommand;

arch()
    ->group(__DIR__, __FILE__)
    // ->skip()
    ->preset()->php()->ignoring([]);

arch()
    ->group(__DIR__, __FILE__)
    ->skip()
    ->preset()->laravel()->ignoring([
        InspireCommand::class,
    ]);

arch()
    ->group(__DIR__, __FILE__)
    // ->skip()
    ->preset()->security()->ignoring([
        'assert',
        'exec',
    ]);

arch()
    ->group(__DIR__, __FILE__)
    ->skip()
    ->preset()->strict()->ignoring([]);

arch()
    ->group(__DIR__, __FILE__)
    ->skip()
    ->preset()->relaxed()->ignoring([]);

arch('will not use debugging functions')
    ->group(__DIR__, __FILE__)
    // ->throwsNoExceptions()
    // ->skip()
    ->expect([
        // 'dd',
        'env',
        'env_explode',
        'env_getcsv',
        'exit',
        'printf',
        'vprintf',
    ])
    // ->each
    ->not->toBeUsed()
    ->ignoring([]);
