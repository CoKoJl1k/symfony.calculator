<?php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request): Response
    {
        //dd($request);
       // return $this->render('base.html.twig');
        return new Response('Hello, World!');
    }

    #[Route('/test2', name: 'test2')]
    public function index2(Request $request): Response
    {
        //dd($request);
        // return $this->render('base.html.twig');
        return new Response('Hello, World2!');
    }

}