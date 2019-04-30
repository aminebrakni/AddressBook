<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /**
     * @var Contact
     */
    protected $contact;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->contact =  new Contact();
    }

    public function testInitialProperties()
    {
        $contact = new Contact();
        $this->assertNull($this->contact->getFirstName());
        $this->assertNull($this->contact->getCompany());
        $this->assertNull($this->contact->getLastName());
        $this->assertNull($this->contact->getEmail());
        $this->assertNull($this->contact->getId());
        $this->assertNull($this->contact->getPhone());
    }

    public function testGetSetFirstName()
    {
        $this->contact->setFirstName('Romain');
        $this->assertEquals('Romain', $this->contact->getFirstName());
    }

    public function testGetSetId(){
        $this->contact->setId('2');
        $this->assertEquals('2', $this->contact->getId());
    }
}