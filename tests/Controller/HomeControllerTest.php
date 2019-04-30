<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHello()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/hello/amine');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-type'));
        $this->assertJsonStringEqualsJsonString('{"msg":"Hello amine"}', $client->getResponse()->getContent());
        // $this->assertContains('Hello World', $crawler->filter('h1')->text());
    }
}
