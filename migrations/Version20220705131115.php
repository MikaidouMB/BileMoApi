<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705131115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD password VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD customers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3568B40 FOREIGN KEY (customers_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C3568B40 ON user (customers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP password, DROP email');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C3568B40');
        $this->addSql('DROP INDEX IDX_8D93D649C3568B40 ON user');
        $this->addSql('ALTER TABLE user DROP customers_id');
    }
}
