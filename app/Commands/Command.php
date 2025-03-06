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

namespace App\Commands;

use Cerbero\CommandValidator\ValidatesInput;

abstract class Command extends \Illuminate\Console\Command
{
    use ValidatesInput;
}
