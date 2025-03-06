<?php

/** @noinspection PhpInternalEntityUsedInspection */
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

use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\CodingStyle\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassLike\RemoveAnnotationRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/bootstrap',
        __DIR__.'/tests',
        __DIR__.'/composer-updater',
        __DIR__.'/favorite-link',
        ...glob(__DIR__.'/{*,.*}.php', \GLOB_BRACE),
    ])
    ->withRootFiles()
    // ->withSkipPath(__DIR__.'/tests.php')
    ->withSkip([
        '**/__snapshots__/*',
        '**/Fixtures/*',
        __DIR__.'/tests.php',
        __FILE__,
    ])
    ->withCache(__DIR__.'/.build/rector/')
    ->withParallel()
    // ->withoutParallel()
    // ->withImportNames(importNames: false)
    ->withImportNames(importDocBlockNames: false, importShortClasses: false)
    ->withFluentCallNewLine()
    ->withAttributesSets(phpunit: true)
    ->withComposerBased(phpunit: true)
    ->withPhpVersion(PhpVersion::PHP_84)
    // ->withDowngradeSets(php84: true)
    ->withPhpSets(php84: true)
    ->withSets([
        PHPUnitSetList::PHPUNIT_110,
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        naming: true,
        instanceOf: true,
        earlyReturn: true,
        phpunitCodeQuality: true,
    )
    ->withRules([
        ArraySpreadInsteadOfArrayMergeRector::class,
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
    ])
    ->withConfiguredRule(RemoveAnnotationRector::class, [
        'phpstan-ignore',
        'phpstan-ignore-next-line',
        'psalm-suppress',
    ])
    ->withConfiguredRule(RenameFunctionRector::class, [
        'Pest\Faker\fake' => 'fake',
        'Pest\Faker\faker' => 'faker',
        // 'faker' => 'fake',
        'test' => 'it',
    ] + array_reduce(
        [
            // 'value',
            // 'base64_encode_file',
            // 'tap',
        ],
        static function (array $carry, string $func): array {
            /** @see https://github.com/laravel/framework/blob/11.x/src/Illuminate/Support/functions.php */
            $carry[$func] = "App\\Support\\$func";

            return $carry;
        },
        []
    ))
    ->withSkip([
        EncapsedStringsToSprintfRector::class,
        ExplicitBoolCompareRector::class,
        LogicalToBooleanRector::class,
        NewlineAfterStatementRector::class,
        ReturnBinaryOrToEarlyReturnRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
    ])
    ->withSkip([
        RemoveEmptyClassMethodRector::class => [
            __DIR__.'/app/Providers/AppServiceProvider.php',
        ],
        StaticArrowFunctionRector::class => $staticArrowFunctionPaths = [
            __DIR__.'/tests',
        ],
        StaticClosureRector::class => $staticArrowFunctionPaths,
    ]);
