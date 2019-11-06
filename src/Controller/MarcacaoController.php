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
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;


class MarcacaoController extends AbstractController
{
  
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
            dump($selecaoesp["especialidade_idespecialidade"]->getId());
            $selec = $selecaoesp["especialidade_idespecialidade"]->getId();
            return $this->redirectToRoute('selecionarmedico', ['id' =>  $selec]);
        }
        
        return $this->render('marcacao/selecionaresp.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/selecionarmedico/{id}", name="selecionarmedico",)
     */
    public function marcacaoHorarioMedico($id ,\Symfony\Component\HttpFoundation\Request $request) : Response

    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $Medico = $entityManager->getRepository(Medico::class)->find(1);
        $horas = $Medico->getEspecialidadeIdespecialidade();
        dump($horas.esnome);

        $form = $this->createFormBuilder()
            ->add('menome', EntityType::class, [
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
