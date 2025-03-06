<?php

/** @noinspection PhpUndefinedNamespaceInspection */
/** @noinspection PhpUndefinedClassInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2018-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Log\LogManager;
use Intonate\TinkerZero\TinkerZeroServiceProvider;
use LaravelZero\Framework\Application;
use Psr\Log\LoggerInterface;

return Application::configure(basePath: \dirname(__DIR__))
    // ->booted(static function (Application $app): void {
    //     if (class_exists(TinkerZeroServiceProvider::class) && !$app->isProduction()) {
    //         $app->register(TinkerZeroServiceProvider::class);
    //     }
    // })
    // ->booted(static function (Application $app): void {
    //     $app->extend(LogManager::class, static function (LoggerInterface $logger, Application $application) {
    //         if (!$logger instanceof LogManager) {
    //             return new LogManager($application);
    //         }
    //
    //         return $logger;
    //     });
    // })
    ->withExceptions(static function (Exceptions $exceptions): void {
        $exceptions->reportable(static fn (Throwable $throwable): bool => !Phar::running());
    })
    ->create();
