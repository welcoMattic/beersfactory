<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Repository\BeerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BeerController extends AbstractController
{
    protected $beerRepository;

    public function __construct(BeerRepository $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    /**
     * @Route({"en": "/beer/{id}", "fr": "/biere/{id}"}, name="beer")
     */
    public function index(Beer $beer): Response
    {
        return $this->render('beer.html.twig', [
            'beer' => $beer,
        ]);
    }
}
