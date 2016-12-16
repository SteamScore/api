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

namespace SteamScore\Api\Tests\Factory\Commands;

use Interop\Container\ContainerInterface;
use SteamScore\Api\Console\Commands\BucketBootstrapCommand;
use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;
use SteamScore\Api\Factory\Commands\BucketBootstrapCommandFactory;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers \SteamScore\Api\Factory\Commands\BucketBootstrapCommandFactory
 */
final class BucketBootstrapCommandFactoryTest extends AbstractTestCase
{
    /**
     * Tests that the factory is invokable.
     */
    public function testIfInvokable()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $manager = $this->prophesize(BucketManagerInterface::class);
        $factory = new BucketBootstrapCommandFactory();

        $container->get(BucketManagerInterface::class)->willReturn($manager->reveal());

        $instance = $factory($container->reveal());

        $this->assertInstanceOf(BucketBootstrapCommand::class, $instance);
    }
}
