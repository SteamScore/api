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

namespace SteamScore\Api\Http\Actions;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SteamScore\Api\Domain\Repositories\GameRepository;
use SteamScore\Api\Http\Document;
use SteamScore\Api\Http\Serializers\GameSerializer;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Parameters;
use Zend\Stratigility\MiddlewareInterface;

final class ListGamesAction implements MiddlewareInterface
{
    /**
     * @var GameRepository
     */
    private $games;

    /**
     * Constructor.
     *
     * @param GameRepository $games
     */
    public function __construct(GameRepository $games)
    {
        $this->games = $games;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $out = null): ResponseInterface
    {
        $parameters = new Parameters($request->getQueryParams());
        $sort = $parameters->getSort(GameSerializer::SORT_FIELDS);
        $limit = $parameters->getLimit(GameSerializer::DEFAULT_LIMIT);
        $offset = $parameters->getOffset();
        $collection = new Collection($this->games->findAll($sort, $limit, offset), new GameSerializer());

        return Document::create($collection)->toPsrHttpResponse($request, $response);
    }
}
