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

     /* Essa é a rota da página ou seja quando for digitar no navegador depois do código do servidor você coloca isso */

    public function cadastrocliente(\Symfony\Component\HttpFoundation\Request $request) : Response
    {
        $cliente= new Cliente(); // Variável e novo objeto cliente

        $form = $this->createFormBuilder($cliente) // Cria um form usando a var cliente
            ->add('clinome', TextType::class, ['label' => 'Nome Completo']) 
            /* A Label precisa ser igual a variavel criada no banco de dados no caso planome e cada add é um campo do form */
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
            $entityManager = $this->getDoctrine()->getManager(); /* G.P - Linhas que adicionei para adicionar
             o que foi cadastrado no banco de dados */
            $entityManager->persist($cliente);
            $entityManager->flush();
        }

        return $this->render('cadastrarcliente/cadastrarcliente.html.twig', [
            /* esse comando eh utilizado para chamar a pagina de html e renderizar ela */
            'form' => $form->createView(),
        ]);
    }
}