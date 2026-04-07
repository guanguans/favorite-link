<?php

/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUnusedAliasInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2018-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\AbstractCommandLineToolFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\AutocorrectFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\BladeFormatterFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\DockerfmtFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\DotenvLinterFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\LintMdFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\MarkdownlintCli2Fixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\MarkdownlintFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\PintFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\ShfmtFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\SqlfluffFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\SqruffFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\TextlintFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\TombiFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\TyposFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\XmllintFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\YamlfmtFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\ZhlintFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\InlineHtml\JsonFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\InlineHtml\SqlOfDoctrineSqlFormatterFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixer\InlineHtml\SqlOfPhpmyadminSqlParserFixer;
use Guanguans\PhpCsFixerCustomFixers\Fixers;
use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return (new Config)
    ->registerCustomFixers($fixers = Fixers::make())
    ->setRules([
        'encoding' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'non_printable_character' => true,
        'single_blank_line_at_eof' => true,

        AutocorrectFixer::name() => true,
        LintMdFixer::name() => true,
        // MarkdownlintCli2Fixer::name() => true,
        // MarkdownlintFixer::name() => true,
        // TextlintFixer::name() => true,
        ZhlintFixer::name() => true,

        // PintFixer::name() => true,
        // BladeFormatterFixer::name() => [ // Custom BladeFormatterFixer configuration
        //     AbstractCommandLineToolFixer::COMMAND => ['path/to/node', 'path/to/blade-formatter'],
        //     AbstractCommandLineToolFixer::OPTIONS => [
        //         '--config' => 'path/to/.bladeformatterrc',
        //         '--extra-liners' => true,
        //         '--indent-size' => 2,
        //         // ...
        //     ],
        // ],
        // BladeFormatterFixer::name() => true, // Default BladeFormatterFixer configuration

        // SqlOfDoctrineSqlFormatterFixer::name() => true,
        // SqlOfPhpmyadminSqlParserFixer::name() => true,
        // SqruffFixer::name() => true,
        // SqlfluffFixer::name() => true,
        // SqlfluffFixer::name() => [
        //     AbstractCommandLineToolFixer::OPTIONS => [
        //         '--dialect' => 'mysql',
        //     ],
        //     AbstractCommandLineToolFixer::EXTENSIONS => ['sql'],
        // ],

        // DockerfmtFixer::name() => true,
        // DotenvLinterFixer::name() => true,
        // JsonFixer::name() => true,
        // ShfmtFixer::name() => true,
        // TombiFixer::name() => true,
        // TyposFixer::name() => true,
        // XmllintFixer::name() => true,
        // YamlfmtFixer::name() => true,
    ])
    ->setFinder(
        Finder::create()
            ->in(__DIR__)
            ->exclude([
                '__snapshots__/',
                'Fixtures/',
                'vendor-bin/',
                '.github/',
            ])
            ->notPath([
                '.chglog/CHANGELOG.tpl.md',
                'CHANGELOG.md',
                // 'composer.json',
                // 'README-zh_CN.md',
                // 'README.md',
            ])
            // ->name($fixers->extensionPatterns())
            ->name([
                // '/\\.markdown$/',
                // '/\\.md$/',
                // '/\\.mdx$/',
                'README.md',
            ])
            ->notName([
                '/\-overview\.md$/',
                '/\.lock$/',
                '/\-lock\.json$/',
                // '/\.php$/',
                '/(?<!\.blade)\.php$/',
                // Exclude temporary files created by `zhlint` in the current working directory.
                '/zhlint\-.*\..*$/',
            ])
            ->ignoreDotFiles(false)
            ->ignoreUnreadableDirs(false)
            ->ignoreVCS(true)
            ->ignoreVCSIgnored(true)
            /** @see \Symfony\Component\Finder\Iterator\SortableIterator::__construct() */
            // ->sortByExtension()
            // ->sort(static fn (SplFileInfo $a, SplFileInfo $b): int => strnatcmp($a->getExtension(), $b->getExtension()))
            ->sortByName()
    )
    ->setCacheFile(\sprintf('%s/.build/php-cs-fixer/%s.cache', __DIR__, pathinfo(__FILE__, \PATHINFO_FILENAME)))
    // ->setParallelConfig(ParallelConfigFactory::sequential())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setUnsupportedPhpVersionAllowed(true)
    ->setUsingCache(true);
