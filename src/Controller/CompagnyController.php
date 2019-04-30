<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
class CompagnyController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Company::class);

        return $this->render('company/index.html.twig', [
            'companys' => $repository->findBy([],['nameCompagny' => 'ASC'],100)
        ]);

    }

    /**
     * @Route("/add", methods={"GET", "POST"})
     * @return Response
     */
    public function addCompany():Response{

    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id": "[1-9][0-9]*"})
     * @return Response
     */
    public function showCompany($id):Response{
        $repository = $this->getDoctrine()->getRepository(Company::class);
        $company = $repository->find($id);

        if (!$company){
            return $this->redirectToRoute('app_company_index');
        }
        return $this->render('company/show.html.twig', [
            'companys' =>$company
        ]);
    }
}
