<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
      $client = static::createClient([], [
        'HTTP_HOST' => 'localhost:8000',
        ] );

        $crawler =$client->request('GET', '/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //echo $client->getResponse()->getContent();die;
        $this->assertEquals(12,$crawler->filter('a:contains("Voir la fiche")')->count());
        //die($client->getResponse()->getContent());
    }

}
