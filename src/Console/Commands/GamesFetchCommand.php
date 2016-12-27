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

use SteamScore\Api\Domain\Jobs\FetchAllGamesJob;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GamesFetchCommand extends Command
{
    /**
     * @var FetchAllGamesJob
     */
    private $job;

    /**
     * Constructor.
     *
     * @param FetchAllGamesJob $job
     */
    public function __construct(FetchAllGamesJob $job)
    {
        parent::__construct();

        $this->job = $job;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('games:fetch');
        $this->setDescription('Fetch all games from SteamSpy.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->job->execute();
    }
}
