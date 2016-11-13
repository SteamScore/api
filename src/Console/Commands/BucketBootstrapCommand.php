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

namespace SteamScore\Api\Console\Commands;

use SteamScore\Api\Domain\Interfaces\BucketManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class BucketBootstrapCommand extends Command
{
    /**
     * @var BucketManagerInterface
     */
    private $manager;

    /**
     * Constructor.
     *
     * @param BucketManagerInterface $manager
     */
    public function __construct(BucketManagerInterface $manager)
    {
        parent::__construct();

        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('bucket:bootstrap');
        $this->setDescription('Creates new users.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->manager->getAll() as $bucket) {
            $bucket->bootstrap();
        }
    }
}
