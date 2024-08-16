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

return [
    // Illuminate\Auth\AuthServiceProvider::class,
    // Illuminate\Broadcasting\BroadcastServiceProvider::class,
    // Illuminate\Bus\BusServiceProvider::class,
    // Illuminate\Cache\CacheServiceProvider::class,
    // Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    // Illuminate\Cookie\CookieServiceProvider::class,
    // Illuminate\Database\DatabaseServiceProvider::class,
    // Illuminate\Encryption\EncryptionServiceProvider::class,
    // Illuminate\Filesystem\FilesystemServiceProvider::class,
    // Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    // Illuminate\Hashing\HashServiceProvider::class,
    // Illuminate\Mail\MailServiceProvider::class,
    // Illuminate\Notifications\NotificationServiceProvider::class,
    // Illuminate\Pagination\PaginationServiceProvider::class,
    // Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    // Illuminate\Pipeline\PipelineServiceProvider::class,
    // Illuminate\Queue\QueueServiceProvider::class,
    // Illuminate\Redis\RedisServiceProvider::class,
    // Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    // Illuminate\View\ViewServiceProvider::class,

    App\Providers\AppServiceProvider::class,
    GrahamCampbell\GitHub\GitHubServiceProvider::class,
];
