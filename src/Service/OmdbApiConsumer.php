<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbApiConsumer
{
    public function __construct(private readonly HttpClientInterface $client, private readonly string $apiKey, private readonly string $apiLink)
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function findMovie(string $movieTitle): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiLink, [
                'query' => [
                    'apiKey' => $this->apiKey,
                    't' => $movieTitle
                ]
            ]
        );

        return $response->toArray();
    }
}