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

arch('will not use debugging functions')
    ->group(__DIR__, __FILE__)
    ->skip()
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
