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
    



      //Esse Codigo NÃO DEVE ESTAR AQUI!!! Ele é referente ao agendamento pós marcação da consulta 


}