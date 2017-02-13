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

namespace SteamScore\Api\Http;

use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tobscure\JsonApi\Document as JsonApiDocument;
use Tobscure\JsonApi\ElementInterface;
use Tobscure\JsonApi\Resource;

final class Document extends JsonApiDocument
{
    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        // Clear json_last_error()
        json_encode(null);

        $json = json_encode($this->toArray(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException(sprintf(
                'Unable to encode data to JSON in %s: %s',
                __CLASS__,
                json_last_error_msg()
            ));
        }

        return $json;
    }

    /**
     * Creates a new instance.
     *
     * @param ElementInterface $data
     *
     * @return self
     */
    public static function create(ElementInterface $data = null): Document
    {
        return new self($data);
    }

    /**
     * Adds an error.
     *
     * @param array $error
     */
    public function addError(array $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * Adds data.
     *
     * @param ElementInterface $data
     *
     * @return $this
     */
    public function withData(ElementInterface $data): Document
    {
        $this->setData($data);

        return $this;
    }

    /**
     * Adds meta.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function withMeta(string $key, string $value): Document
    {
        $this->addMeta($key, $value);

        return $this;
    }

    /**
     * Adds an error.
     *
     * @param array $error
     *
     * @return $this
     */
    public function withError(array $error): Document
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $document = [];

        if (empty($this->jsonapi) === false) {
            $document['jsonapi'] = $this->jsonapi;
        }

        if (empty($this->meta) === false) {
            $document['meta'] = $this->meta;
        }

        if (empty($this->links) === false && empty($this->errors) === true) {
            $document['links'] = $this->links;
        }

        if (empty($this->errors) === false) {
            $document['errors'] = $this->errors;
        } elseif (empty($this->data) === false) {
            $document['data'] = $this->data->toArray();
            $resources = $this->getIncluded($this->data);

            if (count($resources) > 0) {
                $document['included'] = array_map(function (Resource $resource) {
                    return $resource->toArray();
                }, $resources);
            }
        }

        return $document;
    }

    /**
     * Returns a `Psr\Http\Message\ResponseInterface` representation of the document.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function toPsrHttpResponse(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->setJsonapi(['version' => '1.0']);
        $this->addLink('self', (string) $request->getUri());

        $errors = $this->errors;
        $statusCode = $response->getStatusCode();

        if (count($errors) > 0) {
            $statusCode = array_reduce($errors, function ($statusCode, $error) {
                if (isset($error['status']) === false || (int) $error['status'] === $statusCode) {
                    return (int) $statusCode;
                }

                $firstDigitOurs = (int) mb_substr($error['status'], 0, 1);
                $firstDigitTheirs = (int) mb_substr($statusCode, 0, 1);

                if ($statusCode === 200) {
                    $statusCode = $error['status'];
                } elseif ($firstDigitOurs === $firstDigitTheirs || $firstDigitOurs > $firstDigitTheirs) {
                    $statusCode = $firstDigitOurs * 100;
                }

                return (int) $statusCode;
            }, $statusCode);

            if ($statusCode === 200) {
                $statusCode = 500;
            }
        }

        $response->getBody()->write($this->__toString());

        return $response->withStatus($statusCode)->withHeader('Content-Type', 'application/vnd.api+json');
    }
}
