<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class IndexController
{
    /**
     * @Route("/")
     */
    public function index(Environment $twig): Response
    {
        return new Response($twig->render('index.html.twig'));
    }
}
