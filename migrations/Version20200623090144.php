<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623090144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE my_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unique_field VARCHAR(191) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_924D847352858148 ON my_entity (unique_field)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE my_entity');
    }
}
