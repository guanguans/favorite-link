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

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
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
use Rector\Php73\Rector\String_\SensitiveHereNowDocRector;
use Rector\PHPUnit\CodeQuality\Rector\Class_\AddSeeTestAnnotationRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Removing\Rector\Class_\RemoveTraitUseRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Set\ValueObject\DowngradeLevelSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Transform\Rector\String_\StringToClassConstantRector;
use Rector\Transform\ValueObject\StringToClassConstant;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    // \define('MHASH_XXH3', 2 << 0);
    // \define('MHASH_XXH32', 2 << 1);
    // \define('MHASH_XXH64', 2 << 2);
    // \define('MHASH_XXH128', 2 << 3);
    $rectorConfig->importNames(false, false);
    $rectorConfig->importShortClasses(false);
    $rectorConfig->parallel(240);
    // $rectorConfig->disableParallel();
    // $rectorConfig->phpstanConfig(__DIR__.'/phpstan.neon');
    $rectorConfig->phpVersion(PhpVersion::PHP_83);
    // $rectorConfig->cacheClass(FileCacheStorage::class);
    // $rectorConfig->cacheDirectory(__DIR__.'/.build/rector');
    // $rectorConfig->containerCacheDirectory(__DIR__.'/.build/rector');
    // $rectorConfig->disableParallel();
    // $rectorConfig->fileExtensions(['php']);
    // $rectorConfig->indent(' ', 4);
    // $rectorConfig->memoryLimit('2G');
    // $rectorConfig->noDiffs();
    // $rectorConfig->removeUnusedImports();

    $rectorConfig->bootstrapFiles([
        // __DIR__.'/vendor/autoload.php',
    ]);

    $rectorConfig->autoloadPaths([
        // __DIR__.'/vendor/autoload.php',
    ]);

    $rectorConfig->paths([
        __DIR__.'/app',
        __DIR__.'/tests',
        __DIR__.'/.*.php',
        __DIR__.'/*.php',
        __DIR__.'/composer-updater',
    ]);

    $rectorConfig->skip([
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
        RemoveEmptyClassMethodRector::class => [
            __DIR__.'/app/Providers/AppServiceProvider.php',
        ],
        StaticClosureRector::class => [
            __DIR__.'/tests',
        ],

        // paths
        __DIR__.'/tests.php',
        '**/Fixture*',
        '**/Fixture/*',
        '**/Fixtures*',
        '**/Fixtures/*',
        '**/Stub*',
        '**/Stub/*',
        '**/Stubs*',
        '**/Stubs/*',
        '**/Source*',
        '**/Source/*',
        '**/Expected/*',
        '**/Expected*',
        '**/__snapshots__/*',
        '**/__snapshots__*',
    ]);

    $rectorConfig->sets([
        // DowngradeLevelSetList::DOWN_TO_PHP_83,
        LevelSetList::UP_TO_PHP_83,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        // SetList::STRICT_BOOLEANS,
        // SetList::GMAGICK_TO_IMAGICK,
        SetList::NAMING,
        SetList::PRIVATIZATION,
        SetList::TYPE_DECLARATION,
        SetList::EARLY_RETURN,
        SetList::INSTANCEOF,

        PHPUnitSetList::PHPUNIT_100,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        PHPUnitSetList::ANNOTATIONS_TO_ATTRIBUTES,
    ]);

    $rectorConfig->rules([
        // SortAssociativeArrayByKeyRector::class,
        // ToInternalExceptionRector::class,
        AddSeeTestAnnotationRector::class,
        DowngradeArrayFilterNullableCallbackRector::class,
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
    ]);

    $rectorConfig->ruleWithConfiguration(RenameFunctionRector::class, [
        'test' => 'it',
    ]);

    // (function ($rectorConfig): void {
    //     $rectorConfig->ruleConfigurations[AnnotationToAttributeRector::class] = array_filter(
    //         $rectorConfig->ruleConfigurations[AnnotationToAttributeRector::class],
    //         static fn (AnnotationToAttribute $annotationToAttribute): bool => ! in_array(
    //             $annotationToAttribute->getAttributeClass(),
    //             [
    //                 CodeCoverageIgnore::class,
    //             ],
    //             true
    //         )
    //     );
    // })->call($rectorConfig, $rectorConfig);

    // $rectorConfig->ruleWithConfiguration(RenameFunctionRector::class, [
    //     'encrypt' => 'encrypt_old',
    //     'decrypt' => 'decrypt_old',
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RenameAnnotationRector::class, [
    //     new RenameAnnotationByType('PHPUnit\Framework\TestCase', 'test', 'scenario'),
    //     new RenameAnnotation('', 'unknown'),
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
    //     new MethodCallRename('SomeExampleClass', 'oldMethod', 'newMethod'),
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RenameStaticMethodRector::class, [
    //     new RenameStaticMethod('SomeClass', 'oldMethod', 'AnotherExampleClass', 'newStaticMethod'),
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RenamePropertyRector::class, [
    //     new RenameProperty('SomeClass', 'someOldProperty', 'someNewProperty'),
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RenameStringRector::class, [
    //     'ROLE_PREVIOUS_ADMIN' => 'IS_IMPERSONATOR',
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RemoveFuncCallRector::class, [
    //     'var_dump',
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RemoveInterfacesRector::class, [
    //     'SomeInterface',
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(RemoveTraitUseRector::class, [
    //     'TraitNameToRemove',
    // ]);
    //
    // $rectorConfig->ruleWithConfiguration(StringToClassConstantRector::class, [
    //     new StringToClassConstant('compiler.post_dump', 'Yet\AnotherClass', 'CONSTANT'),
    // ]);
};
