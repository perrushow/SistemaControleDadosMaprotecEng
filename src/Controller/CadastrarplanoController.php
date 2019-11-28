<?php

namespace App\Controller;

use App\Entity\Planos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CadastrarplanoController extends AbstractController
{
    /**
     * @Route("/cadastrarplano", name="cadastrarplano")
     */
    public function cadastroplano(Request $request) : Response
    {
        $planos= new Planos();
        $form = $this->createFormBuilder($planos)
            ->add('planome', TextType::class, ['label' => 'Nome do Plano']) /* A Label precisa ser igual a variavel
             criada no banco de dados no caso planome */
            ->add('confirme', SubmitType::class, ['label' => 'Cadastrar Plano'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $planos = $form->getData();
            $entityManager = $this->getDoctrine()->getManager(); /* G.P - Linhas que adicionei para adicionar
             o que foi cadastrado no banco de dados */
            $entityManager->persist($planos);
            $entityManager->flush();
        }

        return $this->render('cadastrarplano/cadastrarplano.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}