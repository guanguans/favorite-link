<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/favorite-link
 */

use Ergebnis\License\Holder;
use Ergebnis\License\Range;
use Ergebnis\License\Type\MIT;
use Ergebnis\License\Url;
use Ergebnis\License\Year;
use Ergebnis\PhpCsFixer\Config\Factory;
use Ergebnis\PhpCsFixer\Config\Fixers;
use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\RuleSet\Php82;
use PhpCsFixer\Finder;

require __DIR__.'/vendor/autoload.php';

return Factory::fromRuleSet(Php82::create()
    ->withHeader(
        (static function (): string {
            $mit = MIT::text(
                __DIR__.'/LICENSE',
                Range::since(
                    Year::fromString('2018'),
                    new DateTimeZone('Asia/Shanghai'),
                ),
                Holder::fromString('guanguans<ityaozm@gmail.com>'),
                Url::fromString('https://github.com/guanguans/favorite-link'),
            );

            // $mit->save();

            return $mit->header();
        })()
    )
    ->withCustomFixers(Fixers::fromFixers(... require __DIR__.'/vendor/guanguans/php-cs-fixer-custom-fixers/config/custom-fixers.php'))
    ->withRules(Rules::fromArray(require __DIR__.'/vendor/guanguans/php-cs-fixer-custom-fixers/config/custom-rules.php'))
    ->withRules(Rules::fromArray(require __DIR__.'/vendor/guanguans/php-cs-fixer-custom-fixers/config/rules.php'))
    ->withRules(Rules::fromArray([
        // '@autoPHPUnitMigration:risky' => true,
        'final_public_method_for_abstract_class' => false,
    ])))
    ->setUsingCache(true)
    ->setCacheFile(\sprintf('%s/.build/php-cs-fixer/%s.cache', __DIR__, pathinfo(__FILE__, \PATHINFO_FILENAME)))
    ->setUnsupportedPhpVersionAllowed(true)
    ->setFinder(
        Finder::create()
            ->in(__DIR__)
            ->exclude([
                'resources/lang/',
                'tests/Fixtures/',
                'vendor-bin/',
            ])
            ->notPath([
                // '/lang\/.*\.json$/',
            ])
            ->notName([
                '/\.blade\.php$/',
            ])
            ->ignoreDotFiles(false)
            ->ignoreUnreadableDirs(false)
            ->ignoreVCS(true)
            ->ignoreVCSIgnored(true)
            ->append([
                __DIR__.'/composer-bump',
                __DIR__.'/favorite-link',
                __DIR__.'/rule-doc-generator',
            ])
    );
