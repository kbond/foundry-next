<?php

declare(strict_types=1);

namespace Zenstruck\Foundry\Tests\Fixture\Migrations\MYSQL;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908143337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE CascadeEntity1 (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, prop1 VARCHAR(255) NOT NULL, INDEX IDX_902FD2493256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CascadeEntity4 (id INT AUTO_INCREMENT NOT NULL, prop1 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Entity1 (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, prop1 VARCHAR(255) NOT NULL, INDEX IDX_F0617053256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Entity2 (id INT AUTO_INCREMENT NOT NULL, prop1 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Entity3 (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CascadeEntity1 ADD CONSTRAINT FK_902FD2493256915B FOREIGN KEY (relation_id) REFERENCES CascadeEntity4 (id)');
        $this->addSql('ALTER TABLE Entity1 ADD CONSTRAINT FK_F0617053256915B FOREIGN KEY (relation_id) REFERENCES Entity2 (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CascadeEntity1 DROP FOREIGN KEY FK_902FD2493256915B');
        $this->addSql('ALTER TABLE Entity1 DROP FOREIGN KEY FK_F0617053256915B');
        $this->addSql('DROP TABLE CascadeEntity1');
        $this->addSql('DROP TABLE CascadeEntity4');
        $this->addSql('DROP TABLE Entity1');
        $this->addSql('DROP TABLE Entity2');
        $this->addSql('DROP TABLE Entity3');
    }
}