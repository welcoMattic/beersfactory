<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Repository\BeerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BeerController extends Controller
{
    protected $beerRepository;

    public function __construct(BeerRepository $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    /**
     * @Route("/beer/{id}", name="beer")
     */
    public function index(Beer $beer): Response
    {
        return $this->render('beer.html.twig', [
            'beer' => $beer,
        ]);
    }
}
