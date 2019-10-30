<?php


namespace App\Controller;


use App\Entity\Especialidade;
use App\Entity\HorariosMedico;
use App\Entity\Medico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

class ListagemControler extends AbstractController
{

    /**
     * @Route("/listagemagendamentos", name="agendamentos")
     */
    public function listagem(\Symfony\Component\HttpFoundation\Request $request) : Response {

    }


}