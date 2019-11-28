<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\Consulta;
use App\Entity\Especialidade;
use App\Entity\HorariosMedico;
use App\Entity\Medico;
use App\Repository\HorariosMedicoRepository;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Query\Expr\Join;
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
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

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
            ->add('confirme', SubmitType::class, ['label' => 'Selecionar']) // SubmitType para enviar o formulario. 
            ->getForm();

        $form->handleRequest($request); // Método do formulário symfony que detecta quando ele é enviado. 

        if ($form->isSubmitted() && $form->isValid())  
        /* Logo depois que o symfony perceber o envio do formulario 'submit' entrará na condição e validará os dados. */    
        {
            $selecliente = $form->getData();   // $selecaoesp pegará o conteudo do formulario através da função getData() em $form.
            $selec = $selecliente["cliente_idcliente"]->getId(); 
            /* Como é passado um array de objetos em $selecaoesp colocamos $selecaoesp["especialidade_idespecialidade"] que aponta para o objeto
             da especialidade selecionada e pegamos apenas o id com  ->getId() função presente em especialidade entity. */

            return $this->redirectToRoute('selecionarespecialidade', ['cli' =>  $selec]); 
            /* E finalmente redirecionamos a rota junto com o id da especialidade selecionada através do $_GET. */
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
        $form = $this->createFormBuilder() // Utiliazamos a função de criar formulario do symfony pegando como referencia a entidade especialidade. 
        ->add('especialidade_idespecialidade', EntityType::class, [  // EntityType para dizer que o campo é referencia de uma entidade. 
            'class' => Especialidade::class,    // class aponta para entidade selecionada no caso 'Especialidade'.
            'choice_label' => 'esnome',    // Renderizamos apenas os nomes das especialidades 'esnome'.
            'label' => 'Especialidade',
        ])
            ->add('confirme', SubmitType::class, ['label' => 'Selecionar']) //SubmitType para enviar o formulario.
            ->getForm();

        //dump($cli);
        $form->handleRequest($request);  // Metodo do formulario symfony que detecta quando ele é enviado.

        if ($form->isSubmitted() && $form->isValid())
        /* Logo depois que o symfony perceber o envio do formulario 'submit' entrará na condição e validará os dados. */
        {
            $selecaoesp = $form->getData(); //$selecaoesp pegará o conteudo do formulario através da função getData() em $form.
            $selec = $selecaoesp["especialidade_idespecialidade"]->getId(); // Como é passado um array de objetos em $selecaoesp colocamos 
            /* $selecaoesp["especialidade_idespecialidade"] que aponta para o objeto da especialidade selecionada e pegamos apenas o ID 
            com ->getId() função presente em especialidade entity. */
            return $this->redirectToRoute('selecionarmedico', ['esp' =>  $selec, 'cli' => $cli]);
            /* E finalmente redirecionamos a rota junto com o id da especialidade selecionada através do $_GET. */
        }

        return $this->render('marcacao/selecionaresp.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/selecionarmedico/{cli}/{esp}", name="selecionarmedico",)
     */
    public function marcacaoHorarioMedicoData($cli ,$esp ,\Symfony\Component\HttpFoundation\Request $request) : Response
    {
        $form = $this->createFormBuilder()
        /* Criando formulario Symfony listando apenas medicos com especialidade selecionada na pagina anterior */
        ->add('data_consulta', \Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('id', EntityType::class, [
                'class' => Medico::class,     //Utilizamos a entidade medico
                'choice_label' => 'menome',   //Escolhemos o Campo nome do medico
                'label' => 'Medico',          //label Medico
                // query_builder cria uma consulta no banco que seleciona apenas medicos da especialidade selecionada
                'query_builder' => function (EntityRepository $er)use ($esp) {
                    return $er->createQueryBuilder('m')
                        ->innerJoin('m.especialidade_idespecialidade', 'e')
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
            $med = $selecaomed["id"]->getId(); // Pega o id do medico selecionado para passar como parametro
            $dia = $selecaomed['data_consulta']->format('l'); // pega o dia da semana da data selecionada para passar como parametro
            $data = $selecaomed['data_consulta']->format('Y-m-d'); // pega a data no formato selecionado para passar como parametro
            $diasemana = function ($dia) { 
            /*Função pra converter a string do dia da semana de ingles que é o padrão para portugues no nosso padrao */
                switch ($dia) {
                    case 'Monday':
                        return 'Segunda';
                    case 'Tuesday':
                        return 'Terça';
                    case 'Wednesday':
                        return 'Quarta';
                    case 'Thursday':
                        return 'Quinta';
                    case 'Friday':
                        return 'Sexta';
                    default:
                        return 'Outro';
                }
            };
            $diasemana = $diasemana($dia); 
         return $this->redirectToRoute('selecionarhorario', ['esp' =>  $esp, 'cli' => $cli, 'med' => $med, 'diasemana' => $diasemana, 'data' => $data]);
        } // Passa os parâmetros para a próxima página
        return $this->render('marcacao/selecionarmed.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/selecionarhorario/{cli}/{esp}/{med}/{diasemana}/{data}/", name="selecionarhorario")
     */
    /* Recebe os parametros enviados da pagina anterior */

    public function marcacaoHorario($cli ,$esp ,\Symfony\Component\HttpFoundation\Request $request, $med, $diasemana, $data) : Response
    {
        $consulta = new Consulta();
        $form = $this->createFormBuilder() 
        /* Criando formulario Symfony listando os horarios disponíveis para o medico e data selecionados na pagina anterior */
        ->add('id', EntityType::class, [
            'class' => HorariosMedico::class, // Utilizamos a entidade horarios medico
            'label' => 'Horários Disponíveis',
            'choice_label' => 'hora',   // label Medico
            // query_builder cria uma consulta no banco que seleciona apenas horarios disponiveis do medico e na data selecionada
            // como a query foi mais complexa e necessitou de uma subquery a função que cria a query foi criada no arquivo HorariosMedicoRepository
            'query_builder' => function (HorariosMedicoRepository $er) use ($med, $diasemana, $data) {
                return $er->findHorarios($med,$diasemana, $data);  
                /* chama a função no repositorio HorariosMedico passando os paramentros do medico, dia da semana e data */
            }
        ])
            ->add('confirme', SubmitType::class, ['label' => 'Selecionar'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $selecaohora = $form->getData(); // puxa os dados enviados do formulario
            $hor = $this->getDoctrine()->getRepository(HorariosMedico::class)->find($selecaohora["id"]->getId()); /*Pega o id referente ao
            horario medico com a relação entre HorariosMedico e Consulta */
            $consulta->setHorariosMedicoIdhorariosmedico($hor); /* Adiciona o horario medico selecionado anteriormente na variavel
            que vai passar os dados para serem salvos no banco */
            $date = date_create_from_format('Y-m-d', $data); /* cria uma data no formato especificado para salvar no banco visto
             que a informação deve ser do tipo DateTime */
            $date->getTimestamp();
            $consulta->setDiaConsulta(new \DateTime($data)); /* Adiciona a data selecionada anteriormente na variavel que vai passar
            os dados para serem salvos no banco */
            $cli = $this->getDoctrine()->getRepository(Cliente::class)->find($cli); /* Pega o id referente ao cliente com a relação entre
            Cliente e Consulta */
            $consulta->setClienteIdcliente($cli); /* Adiciona os dados do cliente selecionado anteriormente na variavel que vai passar
            os dados para serem salvos no banco */
            $med = $this->getDoctrine()->getRepository(Medico::class)->find($med); /* Pega o id referente ao  medico com a relação entre Medico
            e Consulta */
            $consulta->setMedicoIdmedico($med); /* Adiciona os dados do medico selecionado anteriormente na variavel que vai passar os dados
            para serem salvos no banco */
            $entityManager = $this->getDoctrine()->getManager(); /* G.P - Linhas que adicionei para adicionar o que foi cadastrado no
            banco de dados */
            $entityManager->persist($consulta);
            $entityManager->flush();
            return $this->redirectToRoute('selecionarcliente');
        }
        return $this->render('marcacao/selecionarhorario.html.twig', [
            'form' => $form->createView(),
            'diasemana'=> $diasemana,
        ]);
    }
}