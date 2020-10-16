<?php

namespace App\Service;

class CharactersByEpisodeService extends RickAndMortyApi
{
    const EPISODE = 13;

    public function getCharactersFromApi(): void
    {
        $results = $this->requestApi('episode/' . $this::EPISODE);
        $characterIds = [];
        foreach ($results['characters'] as $character) {
            $characterIds[] = $this->getIdFromUrl($character);
        }

        $this->getCharactersInfo($characterIds);
    }
}
