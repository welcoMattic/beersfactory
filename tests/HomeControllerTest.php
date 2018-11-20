<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testH1()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        file_put_contents('public/debug.html', (string) $client->getResponse()->getContent());

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Beers Factory', $crawler->filter('h1')->text());
    }
}
