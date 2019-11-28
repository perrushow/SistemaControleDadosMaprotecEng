<?php

namespace App\Repository;

use App\Entity\Consulta;
use App\Entity\HorariosMedico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method HorariosMedico|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorariosMedico|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorariosMedico[]    findAll()
 * @method HorariosMedico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorariosMedicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorariosMedico::class);
    }

    // /**
    //  * @return HorariosMedico[] Returns an array of HorariosMedico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findHorarios($med, $diasemana, $data) //funcao para achar os horarios disponiveis do medico solicitado
    {
        $subQueryBuilder = $this->getEntityManager()->createQueryBuilder();
        $subQuery = $subQueryBuilder  /* subquery para achar uma lista de horarios que já estão ocupados ou seja que ja tem consultas
        marcadas no dia que o cliente quer agendar */
            ->select('hm.hora') //seleciona o campo hora
            ->from(Consulta::class, 'cs') //tabela consulta com inner join da tabela horarios medico
            ->innerJoin('cs.horarios_medico_idhorariosmedico', 'hm')
            ->where('cs.medico_idmedico = :med and cs.dia_consulta = :dia2')  /* condições onde lista os horarios ja marcados
            do medico :med para o dia da consulta :dia2 */
            ->setParameters(array('med' => $med,
                'dia2' => $data,
            ));

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder  //lista os horarios medicos de um medico especifico em uma data especifica que ainda não tenham sido marcados
            ->select('h')
            ->from(HorariosMedico::class, 'h') //pega os dados tanto da tabela de horariosmedico quanto de medico e de consulta
            ->innerJoin('h.medico_idmedico', 'm')
            ->leftJoin('h.consulta_idconsulta', 'c')
            ->where('m.id = :med and h.dia = :dia') //condicao de listar horarios de um medico especifico e dia especifico
            ->andWhere($queryBuilder->expr()->notIn('h.hora', $subQuery->getDQL())) /* condição para excluir os horarios que 
            já estão marcados selecionados pela subquery */
            ->setParameters(array('med' => $med,
                'dia' => $diasemana,
                'dia2' => $data
            ));
        return $query;
    }

}
