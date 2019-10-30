<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home") //a barra e para pontuar que e a pagina inicial padrao
     */
    public function index() //pede pra que seja gerada a pagina no html
    {
        return $this->render('home/index.html.twig', [ //puxa o template da pagina home
            'controller_name' => 'HomeController',
        ]);
    }
}
