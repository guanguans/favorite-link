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
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => 'Favorite-link',

    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    |
    | This value determines the "version" your application is currently running
    | in. You may want to follow the "Semantic Versioning" - Given a version
    | number MAJOR.MINOR.PATCH when an update happens: https://semver.org.
    |
    */

    'version' => app('git.version'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. This can be overridden using
    | the global command line "--env" option when calling commands.
    |
    */

    'env' => 'development',

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Shanghai',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [
        // // Illuminate\Auth\AuthServiceProvider::class,
        // // Illuminate\Broadcasting\BroadcastServiceProvider::class,
        // // Illuminate\Bus\BusServiceProvider::class,
        // // Illuminate\Cache\CacheServiceProvider::class,
        // // Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        // // Illuminate\Cookie\CookieServiceProvider::class,
        // // Illuminate\Database\DatabaseServiceProvider::class,
        // // Illuminate\Encryption\EncryptionServiceProvider::class,
        // // Illuminate\Filesystem\FilesystemServiceProvider::class,
        // // Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        // // Illuminate\Hashing\HashServiceProvider::class,
        // // Illuminate\Mail\MailServiceProvider::class,
        // // Illuminate\Notifications\NotificationServiceProvider::class,
        // // Illuminate\Pagination\PaginationServiceProvider::class,
        // // Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        // // Illuminate\Pipeline\PipelineServiceProvider::class,
        // // Illuminate\Queue\QueueServiceProvider::class,
        // // Illuminate\Redis\RedisServiceProvider::class,
        // // Illuminate\Session\SessionServiceProvider::class,
        // Illuminate\Translation\TranslationServiceProvider::class,
        // Illuminate\Validation\ValidationServiceProvider::class,
        // // Illuminate\View\ViewServiceProvider::class,
        //
        // App\Providers\AppServiceProvider::class,
        // GrahamCampbell\GitHub\GitHubServiceProvider::class,
    ],
];
