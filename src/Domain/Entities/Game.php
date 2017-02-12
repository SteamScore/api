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

final class Game
{
    /**
     * @var Collection
     */
    private $achievements;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $players;

    /**
     * @var int
     */
    private $scoreRank;

    /**
     * Constructor.
     *
     * @param int    $id
     * @param string $name
     * @param int    $scoreRank
     * @param int    $players
     */
    public function __construct(
        int $id,
        string $name,
        int $scoreRank,
        int $players
    ) {
        $this->achievements = new ArrayCollection();
        $this->id = $id;

        $this->update($name, $scoreRank, $players);
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the name of the game.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the number of people that owns the game.
     *
     * @return int
     */
    public function getPlayers(): int
    {
        return $this->players;
    }

    /**
     * Gets the score rank of the game.
     *
     * @return int
     */
    public function getScoreRank(): int
    {
        return $this->scoreRank;
    }

    /**
     * Updates the game.
     *
     * @param string $name
     * @param int    $scoreRank
     * @param int    $players
     */
    public function update(string $name, int $scoreRank, int $players): void
    {
        $this->name = $name;
        $this->players = $players;
        $this->scoreRank = $scoreRank;
    }
}
