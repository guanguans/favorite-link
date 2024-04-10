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

namespace App\Console\Commands;

use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Stringable;
use Laminas\Feed\Writer\Feed;

/**
 * @see https://github.com/composer/packagist/blob/main/src/Controller/FeedController.php
 */
final class FeedCommand extends Command
{
    protected $signature = <<<'SIGNATURE'
        feed:generate
        {--from=README.md : The path of the README file.}
        SIGNATURE;
    protected $description = 'Generate feed.';

    public function handle(): void
    {
        $items = str(File::get($this->argument('path')))
            ->after($flag = '### ')
            ->prepend($flag)
            ->explode(\PHP_EOL)
            ->filter(filled(...))
            ->reduce(
                static function (Collection $carry, string $line) use ($flag, &$date): Collection {
                    $line = str($line);

                    if ($line->startsWith($flag)) {
                        $date = $line->remove($flag)->trim();

                        return $carry;
                    }

                    $carry[] = [
                        'date' => Date::createFromTimestamp(strtotime((string) $date))->format('Y-m-d'),
                        'description' => (string) $line->match('/\[.*\]/')->trim('[]'),
                        'url' => (string) $line->match('/\(.*\)/')->trim('()'),
                    ];

                    return $carry;
                },
                collect()
            )
            ->pipe(static function (Collection $items): Stringable {
                $feed = new Feed;
                $feed->setEncoding('utf-8');
                $feed->setTitle('❤️ 每天收集喜欢的开源项目');
                $feed->setDescription('❤️ 每天收集喜欢的开源项目');
                $feed->setLink('https://github.com/guanguans/favorite-link');
                $feed->setGenerator('https://github.com/guanguans');

                if ('atom') {
                    $feed->setFeedLink('https://github.com/guanguans/favorite-link/links.atom', 'atom');
                }

                $items->take(3)->each(static function (array $item) use ($feed): void {
                    $entry = $feed->createEntry();
                    $entry->setTitle($item['description']);
                    $entry->setLink($item['url']);
                    $entry->setDateCreated(time());
                    // $entry->setDateModified(time());

                    $feed->addEntry($entry);
                });
                $feed->count()
                    ? $feed->setDateModified($feed->getEntry(0)->getDateModified())
                    : $feed->setDateModified(new \DateTimeImmutable);

                return str($feed->export('atom'));
            })
            ->whenNotEmpty(static function (Stringable $feed): void {
                File::put(base_path('links.atom'), $feed->toString());
            });
    }

    protected function rules(): array
    {
        return [
        ];
    }
}
