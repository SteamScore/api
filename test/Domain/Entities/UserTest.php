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

use SteamScore\Api\Domain\Entities\User;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers \SteamScore\Api\Domain\Entities\User
 */
class UserTest extends AbstractTestCase
{
    /**
     * Provdes tests with user objects.
     *
     * @return array
     */
    public function userObjectsProvider()
    {
        return [
            [
                new User('76561197961959558'),
            ],
        ];
    }

    /**
     * Tests that `getId()` returns a UUID.
     *
     * @dataProvider userObjectsProvider
     */
    public function testGetId(User $user)
    {
        $this->assertSame('76561197961959558', $user->getId());
    }
}
