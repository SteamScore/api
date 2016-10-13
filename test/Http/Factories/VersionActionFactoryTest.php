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

namespace SteamScore\Api\Tests\Http\Factories;

use Interop\Container\ContainerInterface;
use SteamScore\Api\Http\Actions\VersionAction;
use SteamScore\Api\Http\Factories\VersionActionFactory;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @coversDefaultClass VersionActionFactory
 */
final class VersionActionFactoryTest extends AbstractTestCase
{
    /**
     * Tests that the factory is invokable.
     */
    public function testIfInvokable()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory = new VersionActionFactory();

        $container->get('config')->willReturn(['version' => '1.0.0']);

        $instance = $factory($container->reveal());

        $this->assertInstanceOf(VersionAction::class, $instance);
    }
}
