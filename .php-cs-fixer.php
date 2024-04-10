<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/package-skeleton
 */

use Ergebnis\License;
use Ergebnis\PhpCsFixer\Config;
use PhpCsFixer\Finder;

$license = License\Type\MIT::text(
    __DIR__.'/LICENSE',
    License\Range::since(
        License\Year::fromString('2021'),
        new DateTimeZone('Asia/Shanghai'),
    ),
    License\Holder::fromString('guanguans<ityaozm@gmail.com>'),
    License\Url::fromString('https://github.com/guanguans/package-skeleton'),
);

$license->save();

$ruleSet = Config\RuleSet\Php74::create()
    ->withHeader($license->header())
    ->withRules(Config\Rules::fromArray([
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHP73Migration' => true,
        '@PHP74Migration' => true,
        '@PHP74Migration:risky' => true,
        // '@PHP80Migration' => true,
        // '@PHP80Migration:risky' => true,
        // '@PHP81Migration' => true,
        // '@PHP82Migration' => true,
        // '@PHP83Migration' => true,
        // '@PHPUnit75Migration:risky' => true,
        // '@PHPUnit84Migration:risky' => true,
        // '@PHPUnit100Migration:risky' => true,
        // '@DoctrineAnnotation' => true,
        // '@PhpCsFixer' => true,
        // '@PhpCsFixer:risky' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                // 'case',
                'continue',
                'declare',
                // 'default',
                'do',
                'exit',
                'for',
                'foreach',
                'goto',
                'if',
                'include',
                'include_once',
                'phpdoc',
                'require',
                'require_once',
                'return',
                'switch',
                'throw',
                'try',
                'while',
                'yield',
                'yield_from',
            ],
        ],
        'class_definition' => [
            'inline_constructor_arguments' => false,
            'multi_line_extends_each_single_line' => false,
            'single_item_single_line' => false,
            'single_line' => false,
            'space_before_parenthesis' => false,
        ],
        'concat_space' => [
            'spacing' => 'none',
        ],
        // 'empty_loop_condition' => [
        //     'style' => 'for',
        // ],
        'explicit_string_variable' => false,
        'final_class' => false,
        // 'final_internal_class' => false,
        // 'final_public_method_for_abstract_class' => false,
        'logical_operators' => false,
        'mb_str_functions' => false,
        'native_function_invocation' => [
            'exclude' => [],
            'include' => ['@compiler_optimized', 'is_scalar'],
            'scope' => 'all',
            'strict' => true,
        ],
        'new_with_parentheses' => [
            'anonymous_class' => false,
            'named_class' => false,
        ],
        'php_unit_data_provider_name' => [
            'prefix' => 'provide',
            'suffix' => 'Cases',
        ],
        'phpdoc_align' => [
            'align' => 'left',
            'spacing' => 1,
            'tags' => [
                'method',
                'param',
                'property',
                'property-read',
                'property-write',
                'return',
                'throws',
                'type',
                'var',
            ],
        ],
        'phpdoc_line_span' => [
            'const' => 'single',
            'method' => 'multi',
            'property' => 'single',
        ],
        'phpdoc_no_alias_tag' => [
            'replacements' => [
                'link' => 'see',
                'type' => 'var',
            ],
        ],
        'phpdoc_order' => [
            'order' => [
                'deprecated',
                'internal',
                'covers',
                'uses',
                'dataProvider',
                'noinspection',
                'psalm-suppress',
                'param',
                'throws',
                'return',
            ],
        ],
        'phpdoc_to_param_type' => [
            'scalar_types' => true,
            'union_types' => true,
        ],
        'phpdoc_to_property_type' => [
            'scalar_types' => true,
            'union_types' => true,
        ],
        'phpdoc_to_return_type' => [
            'scalar_types' => true,
            'union_types' => true,
        ],
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'single_line_empty_body' => true,
        'statement_indentation' => [
            'stick_comment_to_next_continuous_control_statement' => true,
        ],
        'static_lambda' => false, // pest
    ]));

$ruleSet->withCustomFixers(Config\Fixers::fromFixers(
    ...array_filter(
        iterator_to_array(new PhpCsFixerCustomFixers\Fixers),
        static fn (
            PhpCsFixerCustomFixers\Fixer\AbstractFixer $fixer
        ): bool => !$fixer instanceof PhpCsFixer\Fixer\DeprecatedFixerInterface
            && !\array_key_exists($fixer->getName(), $ruleSet->rules()->toArray())
    )
));

return Config\Factory::fromRuleSet($ruleSet)
    ->setFinder(
        Finder::create()
            ->in(__DIR__)
            ->exclude([
                '.build/',
                '.chglog/',
                '.github/',
                'build/',
                'docs/',
                'vendor-bin/',
                '__snapshots__/',
            ])
            ->append(glob(__DIR__.'/{*,.*}.php', \GLOB_BRACE))
            ->append([
                __DIR__.'/composer-updater',
                __DIR__.'/platform-lint',
            ])
            ->notPath([
                'bootstrap/*',
                'storage/*',
                'resources/view/mail/*',
                'vendor-bin/*',
            ])
            ->notName([
                '*.blade.php',
                // '_ide_helper.php',
            ])
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
    )
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setCacheFile(__DIR__.'/build/php-cs-fixer/.php-cs-fixer.cache');
