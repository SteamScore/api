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

namespace SteamScore\Api\Http\Serializers;

use Tobscure\JsonApi\AbstractSerializer;

class GameSerializer extends AbstractSerializer
{
    const DEFAULT_LIMIT = 100;

    const SORT_FIELDS = ['id', 'name', 'players', 'scoreRank'];

    protected $type = 'games';

    /**
     * {@inheritdoc}
     */
    public function getAttributes($game, array $fields = null): array
    {
        return [
            'name' => $game->getName(),
            'players' => $game->getPlayers(),
            'score-rank' => $game->getScoreRank(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId($game)
    {
        return $game->getId();
    }
}
