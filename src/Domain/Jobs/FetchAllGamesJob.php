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
    public function execute(array $args = []): void
    {
        $remoteGames = $this->steamSpy->findAll();
        $localGames = $this->entities->getRepository(Game::class)->findAll();
        $localGames = array_reduce($localGames, function (array $carry, Game $game) {
            $carry[$game->getId()] = $game;

            return $carry;
        }, []);

        foreach ($remoteGames as $remoteGame) {
            if (is_int($remoteGame['score_rank']) === false) {
                continue;
            }

            $game = $localGames[$remoteGame['appid']] ?? $this->newGame($remoteGame);

            $game->update(trim($remoteGame['name']), $remoteGame['score_rank'], $remoteGame['players_forever']);
            $this->entities->persist($game);
            unset($localGames[$remoteGame['appid']]);
        }

        foreach ($localGames as $localGame) {
            $this->entities->remove($localGame);
        }

        $this->entities->flush();
    }

    private function newGame(array $gameData): Game
    {
        return new Game(
            $gameData['appid'],
            trim($gameData['name']),
            $gameData['score_rank'],
            $gameData['players_forever']
        );
    }
}
