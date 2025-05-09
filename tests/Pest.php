<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection AnonymousFunctionStaticInspection */
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

use Illuminate\Support\Facades\Process;
use Pest\Expectation;
use Symfony\Component\Finder\Finder;
use Tests\TestCase;

uses(TestCase::class)
    ->beforeAll(function (): void {
        clear_same_namespace();
    })
    ->beforeEach(function (): void {
        clear_same_namespace();
    })
    ->afterEach(function (): void {})
    ->afterAll(function (): void {
        Process::run('git checkout -- README.atom README.rss');
    })
    ->in(
        __DIR__,
        // __DIR__.'/Feature',
        // __DIR__.'/Unit'
    );
/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBetween', fn (int $min, int $max): Expectation => expect($this->value)
    ->toBeGreaterThanOrEqual($min)
    ->toBeLessThanOrEqual($max));

expect()->extend('assertCallback', function (Closure $assertions): Expectation {
    $assertions($this->value);

    return $this;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/**
 * @throws ReflectionException
 */
function class_namespace(object|string $class): string
{
    $class = \is_object($class) ? $class::class : $class;

    return new ReflectionClass($class)->getNamespaceName();
}

function fixtures_path(string $path = ''): string
{
    return __DIR__.'/Fixtures'.($path ? \DIRECTORY_SEPARATOR.$path : $path);
}

function clear_same_namespace(): void
{
    foreach (
        Finder::create()
            ->in(__DIR__.'/../vendor/guanguans/ai-commit/app')
            ->name('*.php') as $finder
    ) {
        file_put_contents($finder->getPathname(), '<?php');
    }
}
