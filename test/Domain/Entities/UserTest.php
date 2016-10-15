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

namespace SteamScore\Api\Tests\Domain\Entities;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;
use SteamScore\Api\Domain\Entities\User;

/**
 * @coversDefaultClass User
 */
class UserTest extends TestCase
{
    /**
     * Tests that `getId()` returns a UUID.
     */
    public function testGetId()
    {
        $achievement = new User();

        $this->assertInstanceOf(UuidInterface::class, $achievement->getId());
    }
}
