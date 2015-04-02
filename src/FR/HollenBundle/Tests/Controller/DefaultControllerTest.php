<?php

namespace FR\HollenBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/home');

        $this->assertTrue($crawler->filter('html:contains("Home")')->count() > 0);
    }
}
