<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418151539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE id CASCADE');
        $this->addSql('CREATE SEQUENCE petition_id_seq');
        $this->addSql('SELECT setval(\'petition_id_seq\', (SELECT MAX(id) FROM petition))');
        $this->addSql('ALTER TABLE petition ALTER id SET DEFAULT nextval(\'petition_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE id INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE petition ALTER id DROP DEFAULT');
    }
}
