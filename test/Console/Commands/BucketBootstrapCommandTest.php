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

namespace SteamScore\Api\Tests\Console\Commands;

use bandwidthThrottle\tokenBucket\TokenBucket;
use SteamScore\Api\Console\Commands\BucketBootstrapCommand;
use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;
use SteamScore\Api\Tests\AbstractTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @covers \SteamScore\Api\Console\Commands\BucketBootstrapCommand
 */
class BucketBootstrapCommandTest extends AbstractTestCase
{
    /**
     * Tests that `execute()` executes the command.
     */
    public function testExecute()
    {
        $bucket = $this->prophesize(TokenBucket::class);
        $manager = $this->prophesize(BucketManagerInterface::class);

        $bucket->bootstrap()->shouldBeCalledTimes(1);
        $manager->getAll()->willReturn([$bucket->reveal()]);

        $command = new BucketBootstrapCommand($manager->reveal());
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);
    }
}
