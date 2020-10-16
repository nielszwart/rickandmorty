<?php

namespace App\Service;

class CharactersByDimensionService extends RickAndMortyApi
{
    const DIMENSION = 'Dimension C-137';

    public function getCharactersFromApi(): void
    {
        $results = $this->requestApi('location/?dimension=' . $this::DIMENSION);

        $characterIds = [];
        foreach ($results['results'] as $location) {
            foreach ($location['residents'] as $resident) {
                $characterIds[] = $this->getIdFromUrl($resident);
            }
        }

        $this->getCharactersInfo($characterIds);
    }
}
