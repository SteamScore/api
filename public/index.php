<?php

/*
 * This file is part of SteamScore.
 *
 * (c) Jonas Stendahl <jonas@stendahl.me>
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require 'config/container.php';

/** @var Application $app */
$app = $container->get(Application::class);

$app->run();
