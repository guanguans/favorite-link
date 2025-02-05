<?php

/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpInternalEntityUsedInspection */

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
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DowngradePhp80\Rector\FuncCall\DowngradeArrayFilterNullableCallbackRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\Naming\Rector\Foreach_\RenameForeachValueVariableToMatchMethodCallReturnTypeRector;
use Rector\Php73\Rector\String_\SensitiveHereNowDocRector;
use Rector\PHPUnit\CodeQuality\Rector\Class_\AddSeeTestAnnotationRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Transform\Rector\ClassMethod\ReturnTypeWillChangeRector;
use Rector\Transform\Rector\FileWithoutNamespace\RectorConfigBuilderRector;
use Rector\Transform\ValueObject\ClassMethodReference;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/tests',
        __DIR__.'/.*.php',
        __DIR__.'/*.php',
        __DIR__.'/composer-updater',
    ])
    ->withCache(__DIR__.'/.build/rector/')
    ->withParallel()
    // ->withoutParallel()
    ->withImportNames(false)
    ->withAttributesSets(
        symfony : true,
        doctrine : true,
        mongoDb : true,
        gedmo : true,
        phpunit : true,
        fosRest : true,
        jms : true,
        sensiolabs : true,
        behat : true,
        all : true
    )
    // ->withDeadCodeLevel(42)
    // ->withTypeCoverageLevel(37)
    ->withFluentCallNewLine()
    // ->withPhp74Sets()
    ->withPhpSets(php84: true)
    // ->withDowngradeSets(php84: true)
    ->withPreparedSets(
        deadCode : \true,
        codeQuality : \true,
        codingStyle : \true,
        typeDeclarations : true,
        privatization : true,
        naming : true,
        instanceOf : true,
        earlyReturn : true,
        // strictBooleans : true,
        carbon : true,
        rectorPreset : true,
        phpunitCodeQuality : true,
        doctrineCodeQuality : true,
        symfonyCodeQuality : true,
        symfonyConfigs : true
    )
    ->withSets([
        PHPUnitSetList::PHPUNIT_100,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        PHPUnitSetList::ANNOTATIONS_TO_ATTRIBUTES,
    ])
    ->withComposerBased(twig: true, doctrine: true, phpunit: true, symfony: true)
    ->withRules([
        // SortAssociativeArrayByKeyRector::class,
        AddSeeTestAnnotationRector::class,
        DowngradeArrayFilterNullableCallbackRector::class,
        RectorConfigBuilderRector::class,
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
    ])
    ->withConfiguredRule(
        RenameFunctionRector::class,
        [
            'test' => 'it',
        ] + array_reduce(
            [
                // 'make',
                // 'env_explode',
            ],
            static function (array $carry, string $func): array {
                /** @see https://github.com/laravel/framework/blob/11.x/src/Illuminate/Support/functions.php */
                $carry[$func] = "Guanguans\\SoarPHP\\Support\\$func";

                return $carry;
            },
            []
        )
    )
    ->withConfiguredRule(ReturnTypeWillChangeRector::class, [
        new ClassMethodReference(ArrayAccess::class, 'offsetGet'),
    ])
    ->withSkip([
        '**/__snapshots__/*',
        '**/Fixtures/*',
        __DIR__.'/tests.php',
    ])
    ->withSkip([
        AddSeeTestAnnotationRector::class,
        DowngradeArrayFilterNullableCallbackRector::class,
        EncapsedStringsToSprintfRector::class,
        ExplicitBoolCompareRector::class,
        LogicalToBooleanRector::class,
        NewlineAfterStatementRector::class,
        RemoveUselessReturnTagRector::class,
        ReturnBinaryOrToEarlyReturnRector::class,
        SensitiveHereNowDocRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
    ])
    ->withSkip([
        RemoveEmptyClassMethodRector::class => [
            __DIR__.'/app/Providers/AppServiceProvider.php',
        ],
        RenameForeachValueVariableToMatchMethodCallReturnTypeRector::class => [
            __DIR__.'/tests/Pest.php',
        ],
        StaticArrowFunctionRector::class => $staticClosureSkipPaths = [
            __DIR__.'/tests',
        ],
        StaticClosureRector::class => $staticClosureSkipPaths,
    ]);
