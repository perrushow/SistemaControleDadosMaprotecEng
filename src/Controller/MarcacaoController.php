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
use App\Repository\MedicoRepository;



class MarcacaoController extends AbstractController
{
     /**
     * @Route("/selecionarcliente", name="selecionarcliente")
     */
    public function marcacaoHorarioCliente(\Symfony\Component\HttpFoundation\Request $request) : Response
    {  
        
        $form = $this->createFormBuilder()   
        ->add('cliente_idcliente', EntityType::class, [         
            'class' => Cliente::class,        
            'choice_label' => 'clinome',                  
            'label' => 'Cliente',
        ])
        ->add('confirme', SubmitType::class, ['label' => 'Selecionar']) //SubmitType para enviar o formulario.
        ->getForm();

      
        $form->handleRequest($request);    // Metodo do formulario symfony que detecta quando ele é enviado.

        if ($form->isSubmitted() && $form->isValid())         //Logo depois que o symfony perceber o envio do formulario 'submit' entrará na condição e validará os dados.
        {
           
            $selecliente = $form->getData();        //$selecaoesp pegará o conteudo do formulario através da função getData() em $form.
            
            $selec = $selecliente["cliente_idcliente"]->getId(); //Como é passado um array de objetos em $selecaoesp colocamos $selecaoesp["especialidade_idespecialidade"] que aponta para o objeto da especialidade selecionada e pegamos apenas o id com  ->getId() função presente em especialidade entity.

            return $this->redirectToRoute('selecionarespecialidade', ['cli' =>  $selec]); //E finalmente redirecionamos a rota junto com o id da especialidade selecionada através do $_GET.
        }
        
        return $this->render('marcacao/selecionarcli.html.twig', [
            'form' => $form->createView(),
        ]);
    }


  
    /**
     * @Route("/selecionarespecialidade/{cli}", name="selecionarespecialidade")
     */
    public function marcacaoHorarioEspecialidade($cli ,\Symfony\Component\HttpFoundation\Request $request) : Response
    {  
        // Pagina de seleção de especialidades para marcação de consultar.  
        $form = $this->createFormBuilder()  //utiliazamos a função de criar formulario do symfony pegando como referencia a entidade especialidade. 
        ->add('especialidade_idespecialidade', EntityType::class, [   //EntityType para dizer que o campo é referencia de uma entidade.         
            'class' => Especialidade::class,             //class aponta para entidade selecionada no caso 'Especialidade'.
            'choice_label' => 'esnome',                  //Renderizamos apenas os nomes das especialidades 'esnome'.
            'label' => 'Especialidade',
        ])
        ->add('confirme', SubmitType::class, ['label' => 'Selecionar']) //SubmitType para enviar o formulario.
        ->getForm();

       dump($cli);
        $form->handleRequest($request);    // Metodo do formulario symfony que detecta quando ele é enviado.

        if ($form->isSubmitted() && $form->isValid())         //Logo depois que o symfony perceber o envio do formulario 'submit' entrará na condição e validará os dados.
        {
           
            $selecaoesp = $form->getData();        //$selecaoesp pegará o conteudo do formulario através da função getData() em $form.
            
            $selec = $selecaoesp["especialidade_idespecialidade"]->getId(); //Como é passado um array de objetos em $selecaoesp colocamos $selecaoesp["especialidade_idespecialidade"] que aponta para o objeto da especialidade selecionada e pegamos apenas o id com  ->getId() função presente em especialidade entity.

            return $this->redirectToRoute('selecionarmedico', ['esp' =>  $selec, 'cli' => $cli]); //E finalmente redirecionamos a rota junto com o id da especialidade selecionada através do $_GET.
        }
        
        return $this->render('marcacao/selecionaresp.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/selecionarmedico/{cli}/{esp}", name="selecionarmedico",)
     */
    public function marcacaoHorarioMedico($cli ,$esp ,\Symfony\Component\HttpFoundation\Request $request) : Response

    {
    
        $form = $this->createFormBuilder()                      //Criando formulario Symfony listando apenas medicos com especialidade selecionada na pagina anterior
          ->add('medico_idmedico', EntityType::class, [                 
                'class' => HorariosMedico::class,               //Utilizamos a entidade horarios medico
                'choice_label' => 'hora',                       //Escolhemos o Campo hora
                
                'expanded' => 'true',                           //Aqui ocorre as seleções em radio
                'label' => 'Medico',                            //label Medico
               
                                    //query_builder cria uma consulta no banco que seleciona apenas horarios da especialidade selecionada
                'query_builder' => function (EntityRepository $er)use ($esp) {     
                    return $er->createQueryBuilder('h')
                    
                       ->join('h.medico_idmedico', 'm')
                       ->join('m.especialidade_idespecialidade', 'e')
                       ->where('e.id = :especi')
                       ->setParameter('especi', $esp)
                       ;}
                           
                        
              
                
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
            'i' => 0,
           
        ]);
    }
}
// php bin/console doctrine:query:sql "select * from medico_horarios_medico hm, medico m, horarios_medico h where m.id = hm.medico_id and h.id = hm.horarios_medico_id and m.id = 12"
