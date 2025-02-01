<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250201163750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE accommodation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE attraction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cottage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entry_attraction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pay_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_per_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE accommodation (id INT NOT NULL, location TEXT NOT NULL, accomodation_price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE accommodation_service (accommodation_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(accommodation_id, service_id))');
        $this->addSql('CREATE INDEX IDX_ADA9EE288F3692CD ON accommodation_service (accommodation_id)');
        $this->addSql('CREATE INDEX IDX_ADA9EE28ED5CA9E6 ON accommodation_service (service_id)');
        $this->addSql('CREATE TABLE accommodation_cottage (accommodation_id INT NOT NULL, cottage_id INT NOT NULL, PRIMARY KEY(accommodation_id, cottage_id))');
        $this->addSql('CREATE INDEX IDX_24DAF8178F3692CD ON accommodation_cottage (accommodation_id)');
        $this->addSql('CREATE INDEX IDX_24DAF81717FF9E93 ON accommodation_cottage (cottage_id)');
        $this->addSql('CREATE TABLE attraction (id INT NOT NULL, name VARCHAR(30) NOT NULL, ability SMALLINT NOT NULL, open_time TIME(0) WITHOUT TIME ZONE NOT NULL, close_time TIME(0) WITHOUT TIME ZONE NOT NULL, age_min SMALLINT NOT NULL, cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cottage (id INT NOT NULL, ability SMALLINT NOT NULL, details TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE entry (id INT NOT NULL, date_entry DATE NOT NULL, age SMALLINT NOT NULL, tlf SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE entry_attraction (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE entry_attraction_entry (entry_attraction_id INT NOT NULL, entry_id INT NOT NULL, PRIMARY KEY(entry_attraction_id, entry_id))');
        $this->addSql('CREATE INDEX IDX_A4640609C76E041 ON entry_attraction_entry (entry_attraction_id)');
        $this->addSql('CREATE INDEX IDX_A4640609BA364942 ON entry_attraction_entry (entry_id)');
        $this->addSql('CREATE TABLE entry_attraction_attraction (entry_attraction_id INT NOT NULL, attraction_id INT NOT NULL, PRIMARY KEY(entry_attraction_id, attraction_id))');
        $this->addSql('CREATE INDEX IDX_81CAC90CC76E041 ON entry_attraction_attraction (entry_attraction_id)');
        $this->addSql('CREATE INDEX IDX_81CAC90C3C216F9D ON entry_attraction_attraction (attraction_id)');
        $this->addSql('CREATE TABLE pay (id INT NOT NULL, id_user_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, type_p VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FE8F223C79F37AE5 ON pay (id_user_id)');
        $this->addSql('CREATE TABLE payment_entry (id INT NOT NULL, status_p VARCHAR(255) NOT NULL, date_payment DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE payment_entry_entry (payment_entry_id INT NOT NULL, entry_id INT NOT NULL, PRIMARY KEY(payment_entry_id, entry_id))');
        $this->addSql('CREATE INDEX IDX_59B72E0CFAF00B2A ON payment_entry_entry (payment_entry_id)');
        $this->addSql('CREATE INDEX IDX_59B72E0CBA364942 ON payment_entry_entry (entry_id)');
        $this->addSql('CREATE TABLE payment_entry_pay (payment_entry_id INT NOT NULL, pay_id INT NOT NULL, PRIMARY KEY(payment_entry_id, pay_id))');
        $this->addSql('CREATE INDEX IDX_4E1A7372FAF00B2A ON payment_entry_pay (payment_entry_id)');
        $this->addSql('CREATE INDEX IDX_4E1A7372918501AB ON payment_entry_pay (pay_id)');
        $this->addSql('CREATE TABLE service_per_entry (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service_per_entry_service (service_per_entry_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(service_per_entry_id, service_id))');
        $this->addSql('CREATE INDEX IDX_991E6D1B21F3452D ON service_per_entry_service (service_per_entry_id)');
        $this->addSql('CREATE INDEX IDX_991E6D1BED5CA9E6 ON service_per_entry_service (service_id)');
        $this->addSql('CREATE TABLE service_per_entry_entry (service_per_entry_id INT NOT NULL, entry_id INT NOT NULL, PRIMARY KEY(service_per_entry_id, entry_id))');
        $this->addSql('CREATE INDEX IDX_AB0B0B6321F3452D ON service_per_entry_entry (service_per_entry_id)');
        $this->addSql('CREATE INDEX IDX_AB0B0B63BA364942 ON service_per_entry_entry (entry_id)');
        $this->addSql('ALTER TABLE accommodation_service ADD CONSTRAINT FK_ADA9EE288F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accommodation_service ADD CONSTRAINT FK_ADA9EE28ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accommodation_cottage ADD CONSTRAINT FK_24DAF8178F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accommodation_cottage ADD CONSTRAINT FK_24DAF81717FF9E93 FOREIGN KEY (cottage_id) REFERENCES cottage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_entry ADD CONSTRAINT FK_A4640609C76E041 FOREIGN KEY (entry_attraction_id) REFERENCES entry_attraction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_entry ADD CONSTRAINT FK_A4640609BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_attraction ADD CONSTRAINT FK_81CAC90CC76E041 FOREIGN KEY (entry_attraction_id) REFERENCES entry_attraction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_attraction ADD CONSTRAINT FK_81CAC90C3C216F9D FOREIGN KEY (attraction_id) REFERENCES attraction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pay ADD CONSTRAINT FK_FE8F223C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_entry ADD CONSTRAINT FK_59B72E0CFAF00B2A FOREIGN KEY (payment_entry_id) REFERENCES payment_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_entry ADD CONSTRAINT FK_59B72E0CBA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_pay ADD CONSTRAINT FK_4E1A7372FAF00B2A FOREIGN KEY (payment_entry_id) REFERENCES payment_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_pay ADD CONSTRAINT FK_4E1A7372918501AB FOREIGN KEY (pay_id) REFERENCES pay (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_service ADD CONSTRAINT FK_991E6D1B21F3452D FOREIGN KEY (service_per_entry_id) REFERENCES service_per_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_service ADD CONSTRAINT FK_991E6D1BED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_entry ADD CONSTRAINT FK_AB0B0B6321F3452D FOREIGN KEY (service_per_entry_id) REFERENCES service_per_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_entry ADD CONSTRAINT FK_AB0B0B63BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE accommodation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE attraction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cottage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entry_attraction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pay_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_entry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_per_entry_id_seq CASCADE');
        $this->addSql('ALTER TABLE accommodation_service DROP CONSTRAINT FK_ADA9EE288F3692CD');
        $this->addSql('ALTER TABLE accommodation_service DROP CONSTRAINT FK_ADA9EE28ED5CA9E6');
        $this->addSql('ALTER TABLE accommodation_cottage DROP CONSTRAINT FK_24DAF8178F3692CD');
        $this->addSql('ALTER TABLE accommodation_cottage DROP CONSTRAINT FK_24DAF81717FF9E93');
        $this->addSql('ALTER TABLE entry_attraction_entry DROP CONSTRAINT FK_A4640609C76E041');
        $this->addSql('ALTER TABLE entry_attraction_entry DROP CONSTRAINT FK_A4640609BA364942');
        $this->addSql('ALTER TABLE entry_attraction_attraction DROP CONSTRAINT FK_81CAC90CC76E041');
        $this->addSql('ALTER TABLE entry_attraction_attraction DROP CONSTRAINT FK_81CAC90C3C216F9D');
        $this->addSql('ALTER TABLE pay DROP CONSTRAINT FK_FE8F223C79F37AE5');
        $this->addSql('ALTER TABLE payment_entry_entry DROP CONSTRAINT FK_59B72E0CFAF00B2A');
        $this->addSql('ALTER TABLE payment_entry_entry DROP CONSTRAINT FK_59B72E0CBA364942');
        $this->addSql('ALTER TABLE payment_entry_pay DROP CONSTRAINT FK_4E1A7372FAF00B2A');
        $this->addSql('ALTER TABLE payment_entry_pay DROP CONSTRAINT FK_4E1A7372918501AB');
        $this->addSql('ALTER TABLE service_per_entry_service DROP CONSTRAINT FK_991E6D1B21F3452D');
        $this->addSql('ALTER TABLE service_per_entry_service DROP CONSTRAINT FK_991E6D1BED5CA9E6');
        $this->addSql('ALTER TABLE service_per_entry_entry DROP CONSTRAINT FK_AB0B0B6321F3452D');
        $this->addSql('ALTER TABLE service_per_entry_entry DROP CONSTRAINT FK_AB0B0B63BA364942');
        $this->addSql('DROP TABLE accommodation');
        $this->addSql('DROP TABLE accommodation_service');
        $this->addSql('DROP TABLE accommodation_cottage');
        $this->addSql('DROP TABLE attraction');
        $this->addSql('DROP TABLE cottage');
        $this->addSql('DROP TABLE entry');
        $this->addSql('DROP TABLE entry_attraction');
        $this->addSql('DROP TABLE entry_attraction_entry');
        $this->addSql('DROP TABLE entry_attraction_attraction');
        $this->addSql('DROP TABLE pay');
        $this->addSql('DROP TABLE payment_entry');
        $this->addSql('DROP TABLE payment_entry_entry');
        $this->addSql('DROP TABLE payment_entry_pay');
        $this->addSql('DROP TABLE service_per_entry');
        $this->addSql('DROP TABLE service_per_entry_service');
        $this->addSql('DROP TABLE service_per_entry_entry');
    }
}
