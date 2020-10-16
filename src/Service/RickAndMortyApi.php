<?php

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class RickAndMortyApi
{
    private $client;
    private $characters = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract public function getCharactersFromApi(): void;

    protected function getCharactersInfo(array $characterIds): void
    {
        $characterIds = array_unique($characterIds);

        $this->characters = $this->parseResults($this->client->get('character/[' . implode(',', $characterIds) . ']'));
    }

    public function getCharacters(): array
    {
        return $this->characters;
    }

    private function parseResults(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    protected function getIdFromUrl(string $url): string
    {
        return preg_replace('/[^0-9]/', '', $url);
    }

    protected function requestApi(string $url): array
    {
        return $this->parseResults($this->client->get($url));
    }
}
