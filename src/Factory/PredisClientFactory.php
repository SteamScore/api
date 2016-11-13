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

namespace SteamScore\Api\Factory;

use Interop\Container\ContainerInterface;
use Predis\Client;

final class PredisClientFactory
{
    /**
     * Creates an instanced implementation of `Predis\Client`.
     *
     * @param ContainerInterface $container
     *
     * @return Client
     */
    public function __invoke(ContainerInterface $container): Client
    {
        return new Client();
    }
}
