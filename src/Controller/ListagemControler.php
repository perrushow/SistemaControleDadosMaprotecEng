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
use Symfony\Component\HttpFoundation\Request;

class ListagemControler extends AbstractController
{
    
    /**
     * @Route("/listagemagendamentos", name="agendamentos")  
     */

    public function gerenciarConsultas()                    
    {
        $consultas = $this->getDoctrine()->getRepository(Consulta::class)->findAll(); //pega todas as consultas cadastradas no BD e renderiza na pagina listagem 
        return $this->render('listagem/listagem.html.twig', [
            'consultas' => $consultas,
        ]);
        
    }

    
    /**
     * @Route("/{id}/show", name="consulta_show", methods={"GET"}) 
     */
    public function showConsulta(Consulta $id): Response
    {                   //Pega o id da consulta e renderiza apenas os campos dela  
        return $this->render('listagem/show.html.twig', [
            'consulta' => $id,
        ]);
    }
    
      /**
     * @Route("delete/{id}", name="consulta_delete") 
     */
    public function deleteConsulta($id)
    {   //Ao clicar no botão de desmarcar consulta, o controler pegará o id da consulta para deleta esse cadastro 
        $em = $this->getDoctrine()->getManager();   //Conexão ao gerenciador de entidades 
        $deleteconsulta = $em->getRepository(Consulta::class)->find($id);  //Buscar a consulta com o id selecionado 
        $em->remove($deleteconsulta);  // Deletar essa consulta 
        $em->flush();
        return $this->redirectToRoute('agendamentos'); //Redirecionar para rota 'agendamentos' 
    }

}