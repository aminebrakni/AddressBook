<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Manager\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @var ContactManager
     */
    protected $contactManager;

    protected $env;
    /**
     * ContactController constructor.
     * @param ContactManager $contactManager
     */
    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function index()
    {
        $contacts = $this->contactManager->getAll();

        return $this->render('contact/index.html.twig',[
            'contacts' => $contacts
        ]);
    }

    /**
     * @return Response
     * @Route("/add", methods={"GET", "POST"})
     */
    public function add(Request $request){

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            /**
             * @var Contact $contact
             */
            $contact = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success',"{$contact->getFirstName()} a bien été ajouté");
            return $this->redirectToRoute('app_contact_index');
        }

        return $this->render('contact/add.html.twig',[
            'contactForm' =>$form->createView()
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id": "[1-9][0-9]*"})
     * @return Response
     */
    public function show($id){

        $contacts = $this->contactManager->getId($id);

        if (!$contacts){
            return $this->redirectToRoute('app_contact_index');
            // throw $this->createNotFoundException('contact not found');
        }
        return $this->render('contact/show.html.twig', [
            'contact' =>$contacts
        ]);

    }
}
