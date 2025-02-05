<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Hide Commands
    |--------------------------------------------------------------------------
    |
    | This option allows to hide certain commands from the summary output.
    | They will still be available in your application. Wildcards are supported
    |
    | Examples: "make:*", "list"
    |
    */

    'hide' => [
        'list',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Binary Name
    |--------------------------------------------------------------------------
    |
    | This option allows to override the Artisan binary name that is used
    | in the command usage output.
    |
    */

    'binary' => null,
];
