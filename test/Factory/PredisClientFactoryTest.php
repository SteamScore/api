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

namespace SteamScore\Api\Tests\Factory;

use Interop\Container\ContainerInterface;
use Predis\Client;
use SteamScore\Api\Factory\PredisClientFactory;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers SteamScore\Api\Factory\PredisClientFactory
 */
class PredisClientFactoryTest extends AbstractTestCase
{
    /**
     * Tests that the factory is invokable.
     */
    public function testIfInvokable()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory = new PredisClientFactory();
        $instance = $factory($container->reveal());

        $this->assertInstanceOf(Client::class, $instance);
    }
}
