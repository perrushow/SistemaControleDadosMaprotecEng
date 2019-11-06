<?php


namespace App\Controller;


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
     * @Route("/listagemagendamentos/{id}", name="agendamentos")
     */

     //Esse Codigo NÃO DEVE ESTAR AQUI!!! Ele é referente ao agendamento pós marcação da consulta 
    public function index($id): Response {
        //  composer require --dev symfony/profiler-pack 

        
        $entityManager = $this->getDoctrine()->getManager(); // EntityManager para inserir, atualizar, excluir e encontrar objetos no banco de dados.
        $Medico = $entityManager->getRepository(Medico::class)->find($id); // Cria uma referencia ao repositorio da entidade medico e utiliza a função de busca por id
        $horas = $Medico->getHorarioMedicoIdhorariomedico(); // pega os dados horarios medicos que estão em medico
        return $this->render('listar/horario.html.twig', [
            'medicos' => $Medico,
            'horas' => $horas,
        ]);

      
    }



      //Esse Codigo NÃO DEVE ESTAR AQUI!!! Ele é referente ao agendamento pós marcação da consulta 


}