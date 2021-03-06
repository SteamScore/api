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

namespace SteamScore\Api\Tests;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @var Prophet
     */
    protected $prophet;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->prophet = new Prophet();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->prophet->checkPredictions();
    }
}
