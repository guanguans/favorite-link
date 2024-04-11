<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

namespace App\Commands;

use Cerbero\CommandValidator\ValidatesInput;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends \Illuminate\Console\Command
{
    use ValidatesInput;

    /**
     * Execute the console command.
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($this->validator()->fails()) {
            throw new InvalidArgumentException($this->formatErrors());
        }

        return parent::execute($input, $output);
    }
}
