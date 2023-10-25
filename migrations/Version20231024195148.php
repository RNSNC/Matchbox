<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231024195148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE manufacturer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE matchbox_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE purpose_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE manufacturer (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D0AE6DC5E237E06 ON manufacturer (name)');
        $this->addSql('CREATE TABLE matchbox (id INT NOT NULL, manufacturer_id INT DEFAULT NULL, purpose_id INT DEFAULT NULL, count_match INT NOT NULL, length INT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_445621DCA23B42D ON matchbox (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_445621DC7FC21131 ON matchbox (purpose_id)');
        $this->addSql('CREATE TABLE purpose (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B887B3EB5E237E06 ON purpose (name)');
        $this->addSql('ALTER TABLE matchbox ADD CONSTRAINT FK_445621DCA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchbox ADD CONSTRAINT FK_445621DC7FC21131 FOREIGN KEY (purpose_id) REFERENCES purpose (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE manufacturer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE matchbox_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE purpose_id_seq CASCADE');
        $this->addSql('ALTER TABLE matchbox DROP CONSTRAINT FK_445621DCA23B42D');
        $this->addSql('ALTER TABLE matchbox DROP CONSTRAINT FK_445621DC7FC21131');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE matchbox');
        $this->addSql('DROP TABLE purpose');
    }
}
