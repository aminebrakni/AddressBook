<?php

namespace App\Tests\Controller;

use App\Entity\Contact;
use App\Manager\ContactManager;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testListContactWithDatabase()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des contacts', $crawler->filter('h2')->text());
        //$this->assertContains('Liste des contacts', $crawler->filter('h2')->eq(2)->text());
        $this->assertCount(3, $crawler->filter('h2 + table tr'));

    }

    public function testListContactWithoutDatabase()
    {
        $client = static::createClient();

        // remplacer le vrai objet par le faux ( contactRepository et sa méthode findAll )
        $contacts = [
            (new Contact())->setFirstName('jean')->setLastName('dupont')->setId(123)
        ];

        $mockManager = $this->prophesize(ContactManager::class);
        $mockManager->getAll()->willReturn($contacts)->shouldBeCalledOnce();

        self::$container->set(ContactManager::class, $mockManager->reveal());

        $crawler = $client->request('GET', '/contact/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des contacts', $crawler->filter('h2')->text());

        // ca fonctionne toujours et c'est plus performant
        $this->assertCount(1, $crawler->filter('h2 + table tr'));
    }

    public function testNameEmail(){

        $client = static::createClient();

        $contact = (new Contact())->setId(12);

        $mockManager = $this->prophesize(ContactManager::class);
        $mockManager->getId(12)->willReturn($contact)->shouldBeCalledOnce();

        self::$container->set(ContactManager::class, $mockManager->reveal());

        $crawler = $client->request('GET', '/contact/12');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Afficher un contact', $crawler->filter('h1')->text());

        // ca fonctionne toujours et c'est plus performant
        $this->assertCount(1, $crawler->filter('p:first-of-type'));
    }
}
