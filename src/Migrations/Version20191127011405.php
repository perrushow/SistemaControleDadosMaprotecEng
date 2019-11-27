<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127011405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_B39BFBC77539B838');
        $this->addSql('DROP INDEX IDX_B39BFBC7DE734E51');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cliente_planos AS SELECT cliente_id, planos_id FROM cliente_planos');
        $this->addSql('DROP TABLE cliente_planos');
        $this->addSql('CREATE TABLE cliente_planos (cliente_id INTEGER NOT NULL, planos_id INTEGER NOT NULL, PRIMARY KEY(cliente_id, planos_id), CONSTRAINT FK_B39BFBC7DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B39BFBC77539B838 FOREIGN KEY (planos_id) REFERENCES planos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cliente_planos (cliente_id, planos_id) SELECT cliente_id, planos_id FROM __temp__cliente_planos');
        $this->addSql('DROP TABLE __temp__cliente_planos');
        $this->addSql('CREATE INDEX IDX_B39BFBC77539B838 ON cliente_planos (planos_id)');
        $this->addSql('CREATE INDEX IDX_B39BFBC7DE734E51 ON cliente_planos (cliente_id)');
        $this->addSql('DROP INDEX IDX_A6FE3FDEE0CD465F');
        $this->addSql('DROP INDEX IDX_A6FE3FDE47D695D9');
        $this->addSql('DROP INDEX IDX_A6FE3FDE8BB8409');
        $this->addSql('CREATE TEMPORARY TABLE __temp__consulta AS SELECT id, medico_idmedico_id, cliente_idcliente_id, horarios_medico_idhorariosmedico_id, dia_consulta FROM consulta');
        $this->addSql('DROP TABLE consulta');
        $this->addSql('CREATE TABLE consulta (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, medico_idmedico_id INTEGER NOT NULL, cliente_idcliente_id INTEGER NOT NULL, horarios_medico_idhorariosmedico_id INTEGER DEFAULT NULL, dia_consulta DATE NOT NULL, CONSTRAINT FK_A6FE3FDE8BB8409 FOREIGN KEY (medico_idmedico_id) REFERENCES medico (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A6FE3FDE47D695D9 FOREIGN KEY (cliente_idcliente_id) REFERENCES cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A6FE3FDEE0CD465F FOREIGN KEY (horarios_medico_idhorariosmedico_id) REFERENCES horarios_medico (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO consulta (id, medico_idmedico_id, cliente_idcliente_id, horarios_medico_idhorariosmedico_id, dia_consulta) SELECT id, medico_idmedico_id, cliente_idcliente_id, horarios_medico_idhorariosmedico_id, dia_consulta FROM __temp__consulta');
        $this->addSql('DROP TABLE __temp__consulta');
        $this->addSql('CREATE INDEX IDX_A6FE3FDEE0CD465F ON consulta (horarios_medico_idhorariosmedico_id)');
        $this->addSql('CREATE INDEX IDX_A6FE3FDE47D695D9 ON consulta (cliente_idcliente_id)');
        $this->addSql('CREATE INDEX IDX_A6FE3FDE8BB8409 ON consulta (medico_idmedico_id)');
        $this->addSql('DROP INDEX IDX_9D53DE723BA9BFA5');
        $this->addSql('DROP INDEX IDX_9D53DE72A7FB1C0C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__especialidade_medico AS SELECT medico_id, especialidade_id FROM especialidade_medico');
        $this->addSql('DROP TABLE especialidade_medico');
        $this->addSql('CREATE TABLE especialidade_medico (medico_id INTEGER NOT NULL, especialidade_id INTEGER NOT NULL, PRIMARY KEY(medico_id, especialidade_id), CONSTRAINT FK_9D53DE72A7FB1C0C FOREIGN KEY (medico_id) REFERENCES medico (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9D53DE723BA9BFA5 FOREIGN KEY (especialidade_id) REFERENCES especialidade (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO especialidade_medico (medico_id, especialidade_id) SELECT medico_id, especialidade_id FROM __temp__especialidade_medico');
        $this->addSql('DROP TABLE __temp__especialidade_medico');
        $this->addSql('CREATE INDEX IDX_9D53DE723BA9BFA5 ON especialidade_medico (especialidade_id)');
        $this->addSql('CREATE INDEX IDX_9D53DE72A7FB1C0C ON especialidade_medico (medico_id)');
        $this->addSql('DROP INDEX IDX_9825121637697009');
        $this->addSql('DROP INDEX IDX_98251216A7FB1C0C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__medico_horarios_medico AS SELECT medico_id, horarios_medico_id FROM medico_horarios_medico');
        $this->addSql('DROP TABLE medico_horarios_medico');
        $this->addSql('CREATE TABLE medico_horarios_medico (medico_id INTEGER NOT NULL, horarios_medico_id INTEGER NOT NULL, PRIMARY KEY(medico_id, horarios_medico_id), CONSTRAINT FK_98251216A7FB1C0C FOREIGN KEY (medico_id) REFERENCES medico (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9825121637697009 FOREIGN KEY (horarios_medico_id) REFERENCES horarios_medico (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO medico_horarios_medico (medico_id, horarios_medico_id) SELECT medico_id, horarios_medico_id FROM __temp__medico_horarios_medico');
        $this->addSql('DROP TABLE __temp__medico_horarios_medico');
        $this->addSql('CREATE INDEX IDX_9825121637697009 ON medico_horarios_medico (horarios_medico_id)');
        $this->addSql('CREATE INDEX IDX_98251216A7FB1C0C ON medico_horarios_medico (medico_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_B39BFBC7DE734E51');
        $this->addSql('DROP INDEX IDX_B39BFBC77539B838');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cliente_planos AS SELECT cliente_id, planos_id FROM cliente_planos');
        $this->addSql('DROP TABLE cliente_planos');
        $this->addSql('CREATE TABLE cliente_planos (cliente_id INTEGER NOT NULL, planos_id INTEGER NOT NULL, PRIMARY KEY(cliente_id, planos_id))');
        $this->addSql('INSERT INTO cliente_planos (cliente_id, planos_id) SELECT cliente_id, planos_id FROM __temp__cliente_planos');
        $this->addSql('DROP TABLE __temp__cliente_planos');
        $this->addSql('CREATE INDEX IDX_B39BFBC7DE734E51 ON cliente_planos (cliente_id)');
        $this->addSql('CREATE INDEX IDX_B39BFBC77539B838 ON cliente_planos (planos_id)');
        $this->addSql('DROP INDEX IDX_A6FE3FDE8BB8409');
        $this->addSql('DROP INDEX IDX_A6FE3FDE47D695D9');
        $this->addSql('DROP INDEX IDX_A6FE3FDEE0CD465F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__consulta AS SELECT id, medico_idmedico_id, cliente_idcliente_id, horarios_medico_idhorariosmedico_id, dia_consulta FROM consulta');
        $this->addSql('DROP TABLE consulta');
        $this->addSql('CREATE TABLE consulta (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, medico_idmedico_id INTEGER NOT NULL, cliente_idcliente_id INTEGER NOT NULL, horarios_medico_idhorariosmedico_id INTEGER DEFAULT NULL, dia_consulta DATE NOT NULL)');
        $this->addSql('INSERT INTO consulta (id, medico_idmedico_id, cliente_idcliente_id, horarios_medico_idhorariosmedico_id, dia_consulta) SELECT id, medico_idmedico_id, cliente_idcliente_id, horarios_medico_idhorariosmedico_id, dia_consulta FROM __temp__consulta');
        $this->addSql('DROP TABLE __temp__consulta');
        $this->addSql('CREATE INDEX IDX_A6FE3FDE8BB8409 ON consulta (medico_idmedico_id)');
        $this->addSql('CREATE INDEX IDX_A6FE3FDE47D695D9 ON consulta (cliente_idcliente_id)');
        $this->addSql('CREATE INDEX IDX_A6FE3FDEE0CD465F ON consulta (horarios_medico_idhorariosmedico_id)');
        $this->addSql('DROP INDEX IDX_9D53DE72A7FB1C0C');
        $this->addSql('DROP INDEX IDX_9D53DE723BA9BFA5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__especialidade_medico AS SELECT medico_id, especialidade_id FROM especialidade_medico');
        $this->addSql('DROP TABLE especialidade_medico');
        $this->addSql('CREATE TABLE especialidade_medico (medico_id INTEGER NOT NULL, especialidade_id INTEGER NOT NULL, PRIMARY KEY(medico_id, especialidade_id))');
        $this->addSql('INSERT INTO especialidade_medico (medico_id, especialidade_id) SELECT medico_id, especialidade_id FROM __temp__especialidade_medico');
        $this->addSql('DROP TABLE __temp__especialidade_medico');
        $this->addSql('CREATE INDEX IDX_9D53DE72A7FB1C0C ON especialidade_medico (medico_id)');
        $this->addSql('CREATE INDEX IDX_9D53DE723BA9BFA5 ON especialidade_medico (especialidade_id)');
        $this->addSql('DROP INDEX IDX_98251216A7FB1C0C');
        $this->addSql('DROP INDEX IDX_9825121637697009');
        $this->addSql('CREATE TEMPORARY TABLE __temp__medico_horarios_medico AS SELECT medico_id, horarios_medico_id FROM medico_horarios_medico');
        $this->addSql('DROP TABLE medico_horarios_medico');
        $this->addSql('CREATE TABLE medico_horarios_medico (medico_id INTEGER NOT NULL, horarios_medico_id INTEGER NOT NULL, PRIMARY KEY(medico_id, horarios_medico_id))');
        $this->addSql('INSERT INTO medico_horarios_medico (medico_id, horarios_medico_id) SELECT medico_id, horarios_medico_id FROM __temp__medico_horarios_medico');
        $this->addSql('DROP TABLE __temp__medico_horarios_medico');
        $this->addSql('CREATE INDEX IDX_98251216A7FB1C0C ON medico_horarios_medico (medico_id)');
        $this->addSql('CREATE INDEX IDX_9825121637697009 ON medico_horarios_medico (horarios_medico_id)');
    }
}
