<?php


namespace App\Manager;


use App\Entity\Contact;
use Doctrine\Common\Persistence\ManagerRegistry;

class ContactManager
{
    /**
     * @var ManagerRegistry
     */
    protected $doctrine;

    /**
     * ContactManager constructor.
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getAll(){
        $repo = $this->doctrine->getRepository(Contact::class);

        return $repo->findBy([], ['firstName' => 'ASC'], 100);
    }

    public function getId($id){
        $repo = $this->doctrine->getRepository(Contact::class);

        return $repo->find($id);
    }
}