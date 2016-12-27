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
     * @var int
     */
    private $appId;

    /**
     * @var string|null
     */
    private $developer;

    /**
     * @var UuidInterface
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
     * @var string|null
     */
    private $publisher;

    /**
     * @var int|null
     */
    private $scoreRank;

    /**
     * Constructor.
     *
     * @param int         $appId
     * @param string      $name
     * @param string|null $developer
     * @param string|null $publisher
     * @param int|null    $scoreRank
     * @param int         $players
     */
    public function __construct(
        int $appId,
        string $name,
        ?string $developer,
        ?string $publisher,
        ?int $scoreRank,
        int $players
    ) {
        $this->achievements = new ArrayCollection();
        $this->appId = $appId;
        $this->developer = $developer;
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->players = $players;
        $this->publisher = $publisher;
        $this->scoreRank = $scoreRank;
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
     * Gets the unique Steam identifier.
     *
     * @return int
     */
    public function getAppId(): int
    {
        return $this->appId;
    }

    /**
     * Gets the developer of the game.
     *
     * @return string
     */
    public function getDeveloper(): string
    {
        return $this->developer;
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
        return $this->owners;
    }

    /**
     * Gets the publisher of the game.
     *
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
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
}
