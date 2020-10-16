<?php

namespace App\Service;

use GuzzleHttp\Client;

class RickAndMortyApiClient extends Client
{
    public function __construct(array $config = [])
    {
        $config['base_uri'] = 'https://rickandmortyapi.com/api/';
        $config['verify'] = false;

        parent::__construct($config);
    }
}
