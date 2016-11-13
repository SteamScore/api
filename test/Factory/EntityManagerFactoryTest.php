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

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use SteamScore\Api\Factory\EntityManagerFactory;
use SteamScore\Api\Tests\AbstractTestCase;

/**
 * @covers SteamScore\Api\Factory\EntityManagerFactory
 */
class EntityManagerFactoryTest extends AbstractTestCase
{
    /**
     * Tests that the factory is invokable.
     */
    public function testIfInvokable()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory = new EntityManagerFactory();

        $container->get('config')->willReturn([
            'debug' => false,
            'orm' => [
                'connection' => [
                    'charset' => 'utf8mb4',
                    'collate' => 'utf8mb4_unicode_ci',
                    'dbname' => 'steamscore',
                    'driver' => 'mysqli',
                    'host' => 'localhost',
                    'password' => '',
                    'port' => 3306,
                    'user' => 'root',
                ],
                'mapping' => [
                    'data/orm' => 'SteamScore\Api\Domain\Entities',
                ],
                'proxies' => 'data/proxies',
            ],
        ]);

        $instance = $factory($container->reveal());

        $this->assertInstanceOf(EntityManagerInterface::class, $instance);
    }
}
