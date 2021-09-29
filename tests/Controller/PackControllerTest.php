<?php
// test/Controller/PackControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PackControllerTest extends WebTestCase 
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Pack Nique');
        // $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}