<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\Consulta;
use App\Entity\Especialidade;
use App\Entity\HorariosMedico;
use App\Entity\Medico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarcacaoController extends AbstractController
{
    /**
     * @Route("/selecionartipo", name="selecionartipo")
     */
    public function selecionarTipo(\Symfony\Component\HttpFoundation\Request $request) : Response
    {
        return $this->render('marcacao/selecionartipo.html.twig', [
        ]);
    }


    /**
     * @Route("/selecionarespecialidade", name="selecionarespecialidade")
     */
    public function marcacaoHorarioEspecialidade(\Symfony\Component\HttpFoundation\Request $request) : Response

    {
        $form = $this->createFormBuilder()
        ->add('especialidade_idespecialidade', EntityType::class, [
            'class' => Especialidade::class,
            'choice_label' => 'esnome',
            'label' => 'Especialidade',
        ])
        ->add('confirme', SubmitType::class, ['label' => 'Selecionar'])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $selecaoesp = $form->getData();
        }

        return $this->render('marcacao/selecionaresp.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/selecionarmedico", name="selecionarmedico")
     */
    public function marcacaoHorarioMedico(\Symfony\Component\HttpFoundation\Request $request) : Response

    {
        $form = $this->createFormBuilder()
            ->add('medico_idmedico', EntityType::class, [
                'class' => Medico::class,
                'choice_label' => 'menome',
                'label' => 'Medico',
            ])
            ->add('confirme', SubmitType::class, ['label' => 'Selecionar'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $selecaomed = $form->getData();
        }

        return $this->render('marcacao/selecionarmed.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
// php bin/console doctrine:query:sql "select * from medico_horarios_medico hm, medico m, horarios_medico h where m.id = hm.medico_id and h.id = hm.horarios_medico_id and m.id = 12"
