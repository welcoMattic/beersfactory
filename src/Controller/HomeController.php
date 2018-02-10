<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Repository\BeerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    protected $beerRepository;

    public function __construct(BeerRepository $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        /** @var Beer[] $beers */
        $beers = $this->beerRepository->findAll();

        return $this->render('homepage.html.twig', [
            'beers' => $beers,
        ]);
    }
}
