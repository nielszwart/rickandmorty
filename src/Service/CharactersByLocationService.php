<?php

namespace App\Service;

class CharactersByLocationService extends RickAndMortyApi
{
    const LOCATION = 3;

    public function getCharactersFromApi(): void
    {
        $results = $this->requestApi('location/' . $this::LOCATION);

        $characterIds = [];
        foreach ($results['residents'] as $resident) {
            $characterIds[] = $this->getIdFromUrl($resident);
        }

        $this->getCharactersInfo($characterIds);
    }
}
