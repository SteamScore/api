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

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use Ramsey\Uuid\Doctrine\UuidBinaryType;

final class EntityManagerFactory
{
    /**
     * Creates an instanced implementation of `Doctrine\ORM\EntityManagerInterface`.
     *
     * @param ContainerInterface $container
     *
     * @return EntityManagerInterface
     */
    public function __invoke(ContainerInterface $container): EntityManagerInterface
    {
        if (Type::hasType('uuid_binary') === false) {
            Type::addType('uuid_binary', UuidBinaryType::class);
        }

        $appConfig = $container->get('config');
        $ormConfig = Setup::createConfiguration($appConfig['debug'], $appConfig['orm']['proxies']);
        $driver = new SimplifiedXmlDriver($appConfig['orm']['mapping']);

        $ormConfig->setMetadataDriverImpl($driver);

        return EntityManager::create($appConfig['orm']['connection'], $ormConfig);
    }
}
