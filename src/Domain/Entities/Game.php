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

namespace SteamScore\Api\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Game
{
    /**
     * @var Collection
     */
    private $achievements;

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->achievements = new ArrayCollection();
        $this->id = Uuid::uuid4();
    }

    /**
     * Gets all achievements that belongs to the game.
     *
     * @return Collection
     */
    public function getAchievements(): Collection
    {
        return $this->achievements;
    }

    /**
     * Gets the unique identifier.
     *
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
