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

namespace Tests;

use LaravelZero\Framework\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Faker;

    /**
     * This method is called before each test.
     */
    #[\Override()]
    protected function setUp(): void
    {
        parent::setUp();
        // \DG\BypassFinals::enable();
    }

    /**
     * This method is called after each test.
     */
    #[\Override()]
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->finish();
        \Mockery::close();
    }

    /**
     * Run extra tear down code.
     */
    private function finish(): void
    {
        // call more tear down methods
    }
}
