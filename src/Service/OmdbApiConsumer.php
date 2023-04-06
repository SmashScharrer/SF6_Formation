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
    public function findMovie(string $movieTitle, string $movieYear = null): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiLink, [
                'query' => [
                    'apiKey' => $this->apiKey,
                    't' => $movieTitle,
                    'y' => $movieYear
                ]
            ]
        );

        return $response->toArray();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */

    public function findMovieByID(string $movieID): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiLink, [
                'query' => [
                    'apiKey' => $this->apiKey,
                    'i' => $movieID
                ]
            ]
        );

        return $response->toArray();
    }
}