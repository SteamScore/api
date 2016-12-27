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

namespace SteamScore\Api\Factory\Commands;

use Interop\Container\ContainerInterface;
use SteamScore\Api\Console\Commands\GamesFetchCommand;
use SteamScore\Api\Domain\Jobs\FetchAllGamesJob;

final class GamesFetchCommandFactory
{
    /**
     * Creates an instance of `SteamScore\Api\Console\Commands\GamesFetchCommand`.
     *
     * @param ContainerInterface $container
     *
     * @return GamesFetchCommand
     */
    public function __invoke(ContainerInterface $container): GamesFetchCommand
    {
        return new GamesFetchCommand($container->get(FetchAllGamesJob::class));
    }
}
