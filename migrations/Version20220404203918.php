<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404203918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_E4529B85730DE582');
        $this->addSql('DROP INDEX IDX_E4529B857E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pet AS SELECT id, owner_id, pettype_id, name, date_of_birth FROM pet');
        $this->addSql('DROP TABLE pet');
        $this->addSql('CREATE TABLE pet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, pettype_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, date_of_birth DATE NOT NULL, CONSTRAINT FK_E4529B857E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E4529B85730DE582 FOREIGN KEY (pettype_id) REFERENCES pettype (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO pet (id, owner_id, pettype_id, name, date_of_birth) SELECT id, owner_id, pettype_id, name, date_of_birth FROM __temp__pet');
        $this->addSql('DROP TABLE __temp__pet');
        $this->addSql('CREATE INDEX IDX_E4529B85730DE582 ON pet (pettype_id)');
        $this->addSql('CREATE INDEX IDX_E4529B857E3C61F9 ON pet (owner_id)');
        $this->addSql('DROP INDEX IDX_A51FB0359A353316');
        $this->addSql('DROP INDEX IDX_A51FB03540369CAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vet_specialty AS SELECT vet_id, specialty_id FROM vet_specialty');
        $this->addSql('DROP TABLE vet_specialty');
        $this->addSql('CREATE TABLE vet_specialty (vet_id INTEGER NOT NULL, specialty_id INTEGER NOT NULL, PRIMARY KEY(vet_id, specialty_id), CONSTRAINT FK_A51FB03540369CAB FOREIGN KEY (vet_id) REFERENCES vet (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A51FB0359A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vet_specialty (vet_id, specialty_id) SELECT vet_id, specialty_id FROM __temp__vet_specialty');
        $this->addSql('DROP TABLE __temp__vet_specialty');
        $this->addSql('CREATE INDEX IDX_A51FB0359A353316 ON vet_specialty (specialty_id)');
        $this->addSql('CREATE INDEX IDX_A51FB03540369CAB ON vet_specialty (vet_id)');
        $this->addSql('DROP INDEX IDX_437EE93940369CAB');
        $this->addSql('DROP INDEX IDX_437EE939966F7FB6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__visit AS SELECT id, pet_id, vet_id, datum, information FROM visit');
        $this->addSql('DROP TABLE visit');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pet_id INTEGER NOT NULL, vet_id INTEGER NOT NULL, datum DATE NOT NULL, information VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_437EE939966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_437EE93940369CAB FOREIGN KEY (vet_id) REFERENCES vet (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO visit (id, pet_id, vet_id, datum, information) SELECT id, pet_id, vet_id, datum, information FROM __temp__visit');
        $this->addSql('DROP TABLE __temp__visit');
        $this->addSql('CREATE INDEX IDX_437EE93940369CAB ON visit (vet_id)');
        $this->addSql('CREATE INDEX IDX_437EE939966F7FB6 ON visit (pet_id)');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL COLLATE BINARY, headers CLOB NOT NULL COLLATE BINARY, queue_name VARCHAR(190) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_E4529B857E3C61F9');
        $this->addSql('DROP INDEX IDX_E4529B85730DE582');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pet AS SELECT id, owner_id, pettype_id, name, date_of_birth FROM pet');
        $this->addSql('DROP TABLE pet');
        $this->addSql('CREATE TABLE pet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, pettype_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL)');
        $this->addSql('INSERT INTO pet (id, owner_id, pettype_id, name, date_of_birth) SELECT id, owner_id, pettype_id, name, date_of_birth FROM __temp__pet');
        $this->addSql('DROP TABLE __temp__pet');
        $this->addSql('CREATE INDEX IDX_E4529B857E3C61F9 ON pet (owner_id)');
        $this->addSql('CREATE INDEX IDX_E4529B85730DE582 ON pet (pettype_id)');
        $this->addSql('DROP INDEX IDX_A51FB03540369CAB');
        $this->addSql('DROP INDEX IDX_A51FB0359A353316');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vet_specialty AS SELECT vet_id, specialty_id FROM vet_specialty');
        $this->addSql('DROP TABLE vet_specialty');
        $this->addSql('CREATE TABLE vet_specialty (vet_id INTEGER NOT NULL, specialty_id INTEGER NOT NULL, PRIMARY KEY(vet_id, specialty_id))');
        $this->addSql('INSERT INTO vet_specialty (vet_id, specialty_id) SELECT vet_id, specialty_id FROM __temp__vet_specialty');
        $this->addSql('DROP TABLE __temp__vet_specialty');
        $this->addSql('CREATE INDEX IDX_A51FB03540369CAB ON vet_specialty (vet_id)');
        $this->addSql('CREATE INDEX IDX_A51FB0359A353316 ON vet_specialty (specialty_id)');
        $this->addSql('DROP INDEX IDX_437EE939966F7FB6');
        $this->addSql('DROP INDEX IDX_437EE93940369CAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__visit AS SELECT id, pet_id, vet_id, datum, information FROM visit');
        $this->addSql('DROP TABLE visit');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pet_id INTEGER NOT NULL, vet_id INTEGER NOT NULL, datum DATE NOT NULL, information VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO visit (id, pet_id, vet_id, datum, information) SELECT id, pet_id, vet_id, datum, information FROM __temp__visit');
        $this->addSql('DROP TABLE __temp__visit');
        $this->addSql('CREATE INDEX IDX_437EE939966F7FB6 ON visit (pet_id)');
        $this->addSql('CREATE INDEX IDX_437EE93940369CAB ON visit (vet_id)');
    }
}
