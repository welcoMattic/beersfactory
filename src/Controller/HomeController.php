<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Repository\BeerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
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

    /**
     * @Route("/locale_switcher/{locale}", name="locale_switcher")
     */
    public function localeSwitcher($locale)
    {
        if ($locale) {
            $this->get('session')->set('_locale', $locale);
        }

        return $this->redirectToRoute('home');
    }
}
