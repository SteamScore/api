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

namespace SteamScore\Api\Domain\Jobs;

use Doctrine\ORM\EntityManagerInterface;
use SteamScore\Api\Domain\Entities\Game;
use SteamScore\Api\Domain\Interfaces\JobInterface;
use SteamScore\Api\Domain\Services\SteamSpyService;

final class FetchAllGamesJob implements JobInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entities;

    /**
     * @var SteamSpyService
     */
    private $steamSpy;

    /**
     * Constructor.
     *
     * @param SteamSpyService $steamSpy
     */
    public function __construct(EntityManagerInterface $entities, SteamSpyService $steamSpy)
    {
        $this->entities = $entities;
        $this->steamSpy = $steamSpy;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $args = [])
    {
        $remoteGames = $this->steamSpy->findAll();
        $localGames = $this->entities->getRepository(Game::class)->findAll();
        $localGames = array_reduce($localGames, function (array $carry, Game $game) {
            $carry[$game->getAppId()] = $game;

            return $carry;
        }, []);

        foreach ($remoteGames as $remoteGame) {
            $game = $localGames[$remoteGame['appid']] ?? $this->newGame($remoteGame);

            // @todo: Update data on existing games.

            $this->entities->persist($game);
            unset($localGames[$remoteGame['appid']]);
        }

        foreach ($localGames as $localGame) {
            $this->entities->remove($localGame);
        }

        $this->entities->flush();
    }

    private function newGame(array $gameData)
    {
        return new Game(
            $gameData['appid'],
            $gameData['name'],
            ($gameData['developer'] !== '' && $gameData['developer'] !== null) ? $gameData['developer'] : null,
            ($gameData['publisher'] !== '' && $gameData['publisher'] !== null) ? $gameData['publisher'] : null,
            ($gameData['score_rank'] !== '' && $gameData['score_rank'] !== null) ? $gameData['score_rank'] : null,
            $gameData['players_forever']
        );
    }
}
