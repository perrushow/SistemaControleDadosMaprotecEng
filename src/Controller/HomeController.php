<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home") // A barra é para pontuar que é a pagina inicial padrão
     */
    public function index() // Pede pra que seja gerada a página no html
    {
        return $this->render('home/index.html.twig', [ // Puxa o template da página home
            'controller_name' => 'HomeController',
        ]);
    }
}