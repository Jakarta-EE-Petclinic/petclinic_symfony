<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404201541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE owner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, street_address VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE pet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, pettype_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E4529B857E3C61F9 ON pet (owner_id)');
        $this->addSql('CREATE INDEX IDX_E4529B85730DE582 ON pet (pettype_id)');
        $this->addSql('CREATE TABLE pettype (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE specialty (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE vet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE vet_specialty (vet_id INTEGER NOT NULL, specialty_id INTEGER NOT NULL, PRIMARY KEY(vet_id, specialty_id))');
        $this->addSql('CREATE INDEX IDX_A51FB03540369CAB ON vet_specialty (vet_id)');
        $this->addSql('CREATE INDEX IDX_A51FB0359A353316 ON vet_specialty (specialty_id)');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pet_id INTEGER NOT NULL, vet_id INTEGER NOT NULL, datum DATE NOT NULL, information VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_437EE939966F7FB6 ON visit (pet_id)');
        $this->addSql('CREATE INDEX IDX_437EE93940369CAB ON visit (vet_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE pettype');
        $this->addSql('DROP TABLE specialty');
        $this->addSql('DROP TABLE vet');
        $this->addSql('DROP TABLE vet_specialty');
        $this->addSql('DROP TABLE visit');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
