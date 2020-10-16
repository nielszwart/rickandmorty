<?php

namespace App\Controller;

use App\Service\CharactersByDimensionService;
use App\Service\CharactersByEpisodeService;
use App\Service\CharactersByLocationService;
use App\Service\RickAndMortyApi;
use App\Service\RickAndMortyApiClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class GetCharactersController
{
    private $twig;
    private $client;

    public function __construct(Environment $twig, RickAndMortyApiClient $client)
    {
        $this->twig = $twig;
        $this->client = $client;
    }

    /**
     * @Route("/dimension")
     */
    public function dimension(): Response
    {
        return $this->getCharactersHandle(new CharactersByDimensionService($this->client), 'dimension.html.twig');
    }

    /**
     * @Route("/episode")
     */
    public function episode(): Response
    {
        return $this->getCharactersHandle(new CharactersByEpisodeService($this->client), 'episode.html.twig');
    }

    /**
     * @Route("/location")
     */
    public function location(): Response
    {
        return $this->getCharactersHandle(new CharactersByLocationService($this->client), 'location.html.twig');
    }

    private function getCharactersHandle(RickAndMortyApi $characterService, string $template): Response
    {
        $characterService->getCharactersFromApi();
        $html = $this->twig->render($template, ['characters' => $characterService->getCharacters()]);

        return new Response($html);
    }
}
