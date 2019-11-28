<?php

namespace App\DataFixtures;

use App\Entity\Especialidade;
use App\Entity\HorariosMedico;
use App\Entity\Medico;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\DBAL\Types\DateTimeType;
use \DateTimeInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Retirado horarios extras, foi deixado somente de 8 as 12h
        $esp1 = new Especialidade();
        $esp1->setEsnome("Pediatria");
        $manager->persist($esp1); // esse persist e usado para mandar salvar no banco de dados o nome da especialidade

        $esp2 = new Especialidade();
        $esp2->setEsnome("Dermatologia");
        $manager->persist($esp2);

        $esp3 = new Especialidade();
        $esp3->setEsnome("Neurologia");
        $manager->persist($esp3);

        $esp4 = new Especialidade();
        $esp4->setEsnome("Psiquiatria");
        $manager->persist($esp4);

        $esp5 = new Especialidade();
        $esp5->setEsnome("Otorrinolaringologia");
        $manager->persist($esp5);

        //Horarios_Medicos O campo hora está em string pois não conseguimos fixar o time

        //Segunda-feira

        $horario = new HorariosMedico();
        $horario->setDia("Segunda");
        $horario->setHora("08:00-09:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Segunda");
        $horario->setHora("09:00-10:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Segunda");
        $horario->setHora("10:00-11:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Segunda");
        $horario->setHora("11:00-12:00");
        $manager->persist($horario);

        //Terça-feira

        $horario = new HorariosMedico();
        $horario->setDia("Terça");
        $horario->setHora("08:00-09:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Terça");
        $horario->setHora("09:00-10:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Terça");
        $horario->setHora("10:00-11:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Terça");
        $horario->setHora("11:00-12:00");
        $manager->persist($horario);

        //Quarta-feira

        $horario = new HorariosMedico();
        $horario->setDia("Quarta");
        $horario->setHora("08:00-09:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Quarta");
        $horario->setHora("09:00-10:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Quarta");
        $horario->setHora("10:00-11:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Quarta");
        $horario->setHora("11:00-12:00");
        $manager->persist($horario);

        //Quinta-feira

        $horario = new HorariosMedico();
        $horario->setDia("Quinta");
        $horario->setHora("08:00-09:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Quinta");
        $horario->setHora("09:00-10:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Quinta");
        $horario->setHora("10:00-11:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Quinta");
        $horario->setHora("11:00-12:00");
        $manager->persist($horario);

        //Sexta-feira

        $horario = new HorariosMedico();
        $horario->setDia("Sexta");
        $horario->setHora("08:00-09:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Sexta");
        $horario->setHora("09:00-10:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Sexta");
        $horario->setHora("10:00-11:00");
        $manager->persist($horario);

        $horario = new HorariosMedico();
        $horario->setDia("Sexta");
        $horario->setHora("11:00-12:00");
        $manager->persist($horario);

        //Inserir no Banco de Dados

        $manager->flush();

    }

}