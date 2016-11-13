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

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;
use SteamScore\Api\Domain\Entities\Game;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers SteamScore\Api\Domain\Entities\Game
 */
class GameTest extends AbstractTestCase
{
    /**
     * Tests that `getAchievements()` returns a collection.
     */
    public function testGetAchievements()
    {
        $game = new Game();

        $this->assertInstanceOf(Collection::class, $game->getAchievements());
    }

    /**
     * Tests that `getId()` returns a UUID.
     */
    public function testGetId()
    {
        $game = new Game();

        $this->assertInstanceOf(UuidInterface::class, $game->getId());
    }
}
