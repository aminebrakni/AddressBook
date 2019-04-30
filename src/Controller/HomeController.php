<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @return Response
     * @Route("/hello/{name}" ,methods={"GET"})
     */
    public function hello($name){

        // return new Response('Bonjour',200, ['Content-type' => 'application/json']);
        // return new Response('{"msg": "Bonjour"}',200, ['Content-type' => 'application/json']);

        return new JsonResponse(["msg" => "Hello $name"]);
    }
}
