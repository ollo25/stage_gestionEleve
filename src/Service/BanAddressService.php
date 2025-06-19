<?php

namespace App\Service;

class BanAddressService
{
    private $client;
    private const API_URL = 'https://api-adresse.data.gouv.fr/search/';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function searchAddress(string $query): ?array
    {
        $response = $this->client->request('GET', self::API_URL, [
            'query' => [
                'q' => $query,
                'limit' => 5,
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        return $response->toArray();
    }
}
