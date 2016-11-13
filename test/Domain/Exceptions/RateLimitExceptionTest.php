<?php
declare(strict_types=1);

/*
 * This file is part of SteamScore.
 *
 * (c) SteamScore <code@steamscore.info>
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace SteamScore\Api\Tests\Domain\Exceptions;

use SteamScore\Api\Domain\Exceptions\RateLimitException;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers SteamScore\Api\Domain\Exceptions\RateLimitException
 */
class RateLimitExceptionTest extends AbstractTestCase
{
    /**
     * Tests that `getSecondsToWait()` returns a float.
     */
    public function testGetSecondsToWait()
    {
        $float = 1.337;
        $exception = new RateLimitException($float);

        $this->assertSame($float, $exception->getSecondsToWait());
    }
}
