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

namespace Tests;

use LaravelZero\Framework\Testing\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

abstract class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;
    use VarDumperTestTrait;

    /**
     * This method is called before each test.
     */
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        // \DG\BypassFinals::enable();
        $this->startMockery();
    }

    /**
     * This method is called after each test.
     */
    #[\Override]
    protected function tearDown(): void
    {
        $this->finish();
        $this->closeMockery();
        parent::tearDown();
    }

    /**
     * Run extra tear down code.
     */
    private function finish(): void
    {
        // call more tear down methods
    }
}
