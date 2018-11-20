<?php

namespace App\Command;

use App\Entity\Beer;
use App\Entity\Category;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class AppGiveMeBeersCommand extends Command implements ContainerAwareInterface
{
    const BEER_IDS = ['StkEiv', '65zNUD', 'DGhJbX', 'LDb6oj', '8pAabO', '3XBmmp', 'qQTYZ8', 'Pwu2fR', 'AC98pm', 'htbWwF'];
    const API_HOST = 'https://sandbox-api.brewerydb.com/v2/';

    protected $container;

    protected static $defaultName = 'app:give-me-beers';

    protected function configure()
    {
        $this->setDescription('Get some beers data from Brewerydb');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $em = $this->container->get('doctrine')->getManager();

        $token = $io->ask('Give me your brewerydb api token right now:', 'c99b71dde14ba7bc099bdc01a65a14d9');
        $url = sprintf('%s/beers?key=%s&ids=%s', self::API_HOST, $token, implode(',', self::BEER_IDS));
        $result = file_get_contents($url);

        $payload = json_decode($result, true);

        foreach ($payload['data'] as $beerData) {
            $category = new Category();
            $category->setName($beerData['style']['category']['name']);

            $beer = Beer::createFromPayload($beerData);
            $beer->setCategory($category);

            $em->persist($beer);
            $em->persist($category);
        }

        $em->flush();
        $io->success('Beer has been loaded, cheers! 🍻');
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
