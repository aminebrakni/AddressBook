<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Contact;
use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        /*GROUPS */
        $group = new Group();
        $group->setName('Work');
        $manager->persist($group);

        $company = new Company();
        $company->setNameCompagny('SURF')->setCity('Los Angeles');
        $manager->persist($company);

        $contact = new Contact();
        $contact->setFirstName('mehdi')->setLastName('mok')->setPhone('0123233223')->setCompany($company)->addGroup($group);
        $manager->persist($contact);

        $company = new Company();
        $company->setNameCompagny('Microsoft')->setCity('seattle');
        $manager->persist($company);

        $contact = new Contact();
        $contact->setFirstName('amine')->setLastName('brakni')->setPhone('0123233223')->setCompany($company)->addGroup($group);
        $manager->persist($contact);

        $manager->flush();
    }
}
