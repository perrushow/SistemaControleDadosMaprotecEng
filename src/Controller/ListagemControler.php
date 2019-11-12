<?php


namespace App\Controller;


use App\Entity\Consulta;
use App\Entity\Especialidade;
use App\Entity\HorariosMedico;
use App\Entity\Medico;
use App\Repository\MedicoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ListagemControler extends AbstractController
{
    
    /**
     * @Route("/listagemagendamentos/", name="agendamentos")
     */

    public function gerenciarConsultas()
    {
        $consultas = $this->getDoctrine()->getRepository(Consulta::class)->findAll(); //pega todas as consultas cadastradas no BD e renderiza na pagina listagem
        return $this->render('listagem/listagem.html.twig', [
            'consultas' => $consultas,
        ]);
    }

}