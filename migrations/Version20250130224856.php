<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130224856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, phone_number INT NOT NULL, number_people INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_service (id INT NOT NULL, reservation_date DATE NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_service_user (user_service_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(user_service_id, user_id))');
        $this->addSql('CREATE INDEX IDX_C31C1EA74A3B6F0A ON user_service_user (user_service_id)');
        $this->addSql('CREATE INDEX IDX_C31C1EA7A76ED395 ON user_service_user (user_id)');
        $this->addSql('CREATE TABLE user_service_service (user_service_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(user_service_id, service_id))');
        $this->addSql('CREATE INDEX IDX_3CC5A4C14A3B6F0A ON user_service_service (user_service_id)');
        $this->addSql('CREATE INDEX IDX_3CC5A4C1ED5CA9E6 ON user_service_service (service_id)');
        $this->addSql('ALTER TABLE user_service_user ADD CONSTRAINT FK_C31C1EA74A3B6F0A FOREIGN KEY (user_service_id) REFERENCES user_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_user ADD CONSTRAINT FK_C31C1EA7A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_service ADD CONSTRAINT FK_3CC5A4C14A3B6F0A FOREIGN KEY (user_service_id) REFERENCES user_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_service ADD CONSTRAINT FK_3CC5A4C1ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_service_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_service_user DROP CONSTRAINT FK_C31C1EA74A3B6F0A');
        $this->addSql('ALTER TABLE user_service_user DROP CONSTRAINT FK_C31C1EA7A76ED395');
        $this->addSql('ALTER TABLE user_service_service DROP CONSTRAINT FK_3CC5A4C14A3B6F0A');
        $this->addSql('ALTER TABLE user_service_service DROP CONSTRAINT FK_3CC5A4C1ED5CA9E6');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user_service');
        $this->addSql('DROP TABLE user_service_user');
        $this->addSql('DROP TABLE user_service_service');
    }
}
