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

use App\Providers\AppServiceProvider;
use GrahamCampbell\GitHub\GitHubServiceProvider;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Cache\CacheServiceProvider;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;
use Illuminate\Foundation\Providers\FoundationServiceProvider;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pipeline\PipelineServiceProvider;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\View\ViewServiceProvider;

/**
 * Copyright (c) 2018-2025 guanguans<ityaozm@gmail.com>.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

return [
    // AuthServiceProvider::class,
    // BroadcastServiceProvider::class,
    // BusServiceProvider::class,
    // CacheServiceProvider::class,
    // ConsoleSupportServiceProvider::class,
    // CookieServiceProvider::class,
    // DatabaseServiceProvider::class,
    // EncryptionServiceProvider::class,
    // FilesystemServiceProvider::class,
    // FoundationServiceProvider::class,
    // HashServiceProvider::class,
    // MailServiceProvider::class,
    // NotificationServiceProvider::class,
    // PaginationServiceProvider::class,
    // PasswordResetServiceProvider::class,
    // PipelineServiceProvider::class,
    // QueueServiceProvider::class,
    // RedisServiceProvider::class,
    // SessionServiceProvider::class,
    TranslationServiceProvider::class,
    ValidationServiceProvider::class,
    // ViewServiceProvider::class,

    AppServiceProvider::class,
    GitHubServiceProvider::class,
];
