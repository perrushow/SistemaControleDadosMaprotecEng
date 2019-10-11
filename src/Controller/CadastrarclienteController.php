<?php

namespace App\Controller;

use App\Entity\Planos;
use App\Entity\Cliente;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CadastrarclienteController extends AbstractController
{
    /**
     * @Route("/cadastrarcliente", name="cadastrarcliente")
     */
    public function cadastrocliente(\Symfony\Component\HttpFoundation\Request $request) : Response
    {
        $cliente= new Cliente();

        $form = $this->createFormBuilder($cliente)
            ->add('clinome', TextType::class, ['label' => 'Nome Completo']) //A Label precisa ser igual a variavel criada no DB no caso planome
            ->add('telefone', TextType::class, ['label' => 'Telefone'])
            ->add('planos_idplanos', EntityType::class, [
                'class' => Planos::class,
                'choice_label' => 'planome',
                'multiple' => 'true',
                'label' => 'Plano de Saude',
                ])
            ->add('confirme', SubmitType::class, ['label' => 'Cadastrar Cliente'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $cliente = $form->getData();
            $entityManager = $this->getDoctrine()->getManager(); //G.P - Linhas que adicionei para adicionar oq foi cadastrado no BD
            $entityManager->persist($cliente);
            $entityManager->flush();

        }

        return $this->render('cadastrarcliente/cadastrarcliente.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
