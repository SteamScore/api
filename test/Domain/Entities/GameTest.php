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
 * @covers \SteamScore\Api\Domain\Entities\Game
 */
class GameTest extends AbstractTestCase
{
    /**
     * Provdes tests with game objects.
     *
     * @return array
     */
    public function gameObjectsProvider()
    {
        return [
            [
                new Game(
                    316790,
                    'Grim Fandango Remastered',
                    'Double Fine Productions',
                    'Double Fine Productions',
                    76,
                    330606
                ),
            ],
        ];
    }

    /**
     * Tests that `getAchievements()` returns a collection.
     *
     * @dataProvider gameObjectsProvider
     */
    public function testGetAchievements(Game $game)
    {
        $this->assertInstanceOf(Collection::class, $game->getAchievements());
    }

    /**
     * Tests that `getId()` returns a UUID.
     *
     * @dataProvider gameObjectsProvider
     */
    public function testGetId(Game $game)
    {
        $this->assertInstanceOf(UuidInterface::class, $game->getId());
    }
}
