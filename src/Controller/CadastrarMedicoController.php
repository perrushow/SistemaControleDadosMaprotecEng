<?php

namespace App\Controller;

use App\Entity\Medico;
use App\Entity\HorariosMedico;
use App\Entity\Especialidade;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CadastrarMedicoController extends AbstractController
{
    /**
     * @Route("/cadastrarmedico", name="cadastrarmedico")
     */
    public function cadastrarmedico(\Symfony\Component\HttpFoundation\Request $request) : Response
    {
        $Medico= new Medico();

        $form = $this->createFormBuilder($Medico)                       //A Label precisa ser igual a variavel criada no DB no caso menome, dia1, dia2...
            ->add('menome', TextType::class, ['label' => 'Nome do Medico'])  //Nome da coluna medico no DB
        //         //Coluna de medicos que puxa a tabela especialidade
            ->add('especialidade_idespecialidade', EntityType::class, [
                'class' => Especialidade::class,
                'choice_label' => 'esnome',
                'multiple' => 'true',
                'label' => 'Especialidade',
                ])                                       //Coluna de medicos que puxa a tabela HorariosMedico, contendo os periodos de agendamento
            ->add('horario_medico_idhorariomedico', EntityType::class, [
                            'class' => HorariosMedico::class,
                            'choice_label' => 'hora',
                            'multiple' => 'true',
                            'expanded' => 'true',
                            'label' => 'Horario Medico',
                            ])
            ->add('confirme', SubmitType::class, ['label' => 'Cadastrar Medico'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $Medico = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();// Inseri no DB
            $entityManager->persist($Medico);
            $entityManager->flush();

        }

        return $this->render('cadastrarmedico/cadastrarmedico.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

// php bin/console doctrine:query:sql "select * from medico_horarios_medico hm, medico m, horarios_medico h where m.id = hm.medico_id and h.id = hm.horarios_medico_id and m.id = 12"
