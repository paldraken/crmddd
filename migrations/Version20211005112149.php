<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005112149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_companies (id VARCHAR(36) NOT NULL, registered_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN auth_companies.registered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE auth_users (id VARCHAR(36) NOT NULL, company_id VARCHAR(255) DEFAULT NULL, hashed_password VARCHAR(512) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, email VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8A1F49C979B1AD6 ON auth_users (company_id)');
        $this->addSql('COMMENT ON COLUMN auth_users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE customers (id VARCHAR(36) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN customers.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE auth_users ADD CONSTRAINT FK_D8A1F49C979B1AD6 FOREIGN KEY (company_id) REFERENCES auth_companies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE auth_users DROP CONSTRAINT FK_D8A1F49C979B1AD6');
        $this->addSql('DROP TABLE auth_companies');
        $this->addSql('DROP TABLE auth_users');
        $this->addSql('DROP TABLE customers');
    }
}
