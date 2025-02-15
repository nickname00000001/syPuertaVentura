<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211014506 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE food_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pay_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plates_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_per_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
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
        $this->addSql('CREATE TABLE food (id INT NOT NULL, payment DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, food_order_id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5299398A5D24A7A ON "order" (food_order_id)');
        $this->addSql('CREATE TABLE pay (id INT NOT NULL, id_user_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, type_p VARCHAR(255) NOT NULL, payment_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FE8F223C79F37AE5 ON pay (id_user_id)');
        $this->addSql('CREATE TABLE payment_entry (id INT NOT NULL, status_p VARCHAR(255) NOT NULL, date_payment DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE payment_entry_entry (payment_entry_id INT NOT NULL, entry_id INT NOT NULL, PRIMARY KEY(payment_entry_id, entry_id))');
        $this->addSql('CREATE INDEX IDX_59B72E0CFAF00B2A ON payment_entry_entry (payment_entry_id)');
        $this->addSql('CREATE INDEX IDX_59B72E0CBA364942 ON payment_entry_entry (entry_id)');
        $this->addSql('CREATE TABLE payment_entry_pay (payment_entry_id INT NOT NULL, pay_id INT NOT NULL, PRIMARY KEY(payment_entry_id, pay_id))');
        $this->addSql('CREATE INDEX IDX_4E1A7372FAF00B2A ON payment_entry_pay (payment_entry_id)');
        $this->addSql('CREATE INDEX IDX_4E1A7372918501AB ON payment_entry_pay (pay_id)');
        $this->addSql('CREATE TABLE plate (id INT NOT NULL, name VARCHAR(30) NOT NULL, description TEXT NOT NULL, value INT NOT NULL, stock INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plates_order (id INT NOT NULL, nro_order_id INT NOT NULL, nro_plates INT NOT NULL, tplate VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1D63043D7942F140 ON plates_order (nro_order_id)');
        $this->addSql('CREATE TABLE plates_order_plate (plates_order_id INT NOT NULL, plate_id INT NOT NULL, PRIMARY KEY(plates_order_id, plate_id))');
        $this->addSql('CREATE INDEX IDX_8BAFE1BAFA254608 ON plates_order_plate (plates_order_id)');
        $this->addSql('CREATE INDEX IDX_8BAFE1BADF66E98B ON plates_order_plate (plate_id)');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, service_asociate_id INT NOT NULL, phone_number INT NOT NULL, number_people INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E19D9AD2B2AB81DB ON service (service_asociate_id)');
        $this->addSql('CREATE TABLE service_per_entry (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service_per_entry_service (service_per_entry_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(service_per_entry_id, service_id))');
        $this->addSql('CREATE INDEX IDX_991E6D1B21F3452D ON service_per_entry_service (service_per_entry_id)');
        $this->addSql('CREATE INDEX IDX_991E6D1BED5CA9E6 ON service_per_entry_service (service_id)');
        $this->addSql('CREATE TABLE service_per_entry_entry (service_per_entry_id INT NOT NULL, entry_id INT NOT NULL, PRIMARY KEY(service_per_entry_id, entry_id))');
        $this->addSql('CREATE INDEX IDX_AB0B0B6321F3452D ON service_per_entry_entry (service_per_entry_id)');
        $this->addSql('CREATE INDEX IDX_AB0B0B63BA364942 ON service_per_entry_entry (entry_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE user_service (id INT NOT NULL, reservation_date DATE NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_service_user (user_service_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(user_service_id, user_id))');
        $this->addSql('CREATE INDEX IDX_C31C1EA74A3B6F0A ON user_service_user (user_service_id)');
        $this->addSql('CREATE INDEX IDX_C31C1EA7A76ED395 ON user_service_user (user_id)');
        $this->addSql('CREATE TABLE user_service_service (user_service_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(user_service_id, service_id))');
        $this->addSql('CREATE INDEX IDX_3CC5A4C14A3B6F0A ON user_service_service (user_service_id)');
        $this->addSql('CREATE INDEX IDX_3CC5A4C1ED5CA9E6 ON user_service_service (service_id)');
        $this->addSql('ALTER TABLE accommodation_service ADD CONSTRAINT FK_ADA9EE288F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accommodation_service ADD CONSTRAINT FK_ADA9EE28ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accommodation_cottage ADD CONSTRAINT FK_24DAF8178F3692CD FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE accommodation_cottage ADD CONSTRAINT FK_24DAF81717FF9E93 FOREIGN KEY (cottage_id) REFERENCES cottage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_entry ADD CONSTRAINT FK_A4640609C76E041 FOREIGN KEY (entry_attraction_id) REFERENCES entry_attraction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_entry ADD CONSTRAINT FK_A4640609BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_attraction ADD CONSTRAINT FK_81CAC90CC76E041 FOREIGN KEY (entry_attraction_id) REFERENCES entry_attraction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry_attraction_attraction ADD CONSTRAINT FK_81CAC90C3C216F9D FOREIGN KEY (attraction_id) REFERENCES attraction (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398A5D24A7A FOREIGN KEY (food_order_id) REFERENCES food (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pay ADD CONSTRAINT FK_FE8F223C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_entry ADD CONSTRAINT FK_59B72E0CFAF00B2A FOREIGN KEY (payment_entry_id) REFERENCES payment_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_entry ADD CONSTRAINT FK_59B72E0CBA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_pay ADD CONSTRAINT FK_4E1A7372FAF00B2A FOREIGN KEY (payment_entry_id) REFERENCES payment_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_entry_pay ADD CONSTRAINT FK_4E1A7372918501AB FOREIGN KEY (pay_id) REFERENCES pay (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plates_order ADD CONSTRAINT FK_1D63043D7942F140 FOREIGN KEY (nro_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plates_order_plate ADD CONSTRAINT FK_8BAFE1BAFA254608 FOREIGN KEY (plates_order_id) REFERENCES plates_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plates_order_plate ADD CONSTRAINT FK_8BAFE1BADF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2B2AB81DB FOREIGN KEY (service_asociate_id) REFERENCES food (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_service ADD CONSTRAINT FK_991E6D1B21F3452D FOREIGN KEY (service_per_entry_id) REFERENCES service_per_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_service ADD CONSTRAINT FK_991E6D1BED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_entry ADD CONSTRAINT FK_AB0B0B6321F3452D FOREIGN KEY (service_per_entry_id) REFERENCES service_per_entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_per_entry_entry ADD CONSTRAINT FK_AB0B0B63BA364942 FOREIGN KEY (entry_id) REFERENCES entry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_user ADD CONSTRAINT FK_C31C1EA74A3B6F0A FOREIGN KEY (user_service_id) REFERENCES user_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_user ADD CONSTRAINT FK_C31C1EA7A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_service ADD CONSTRAINT FK_3CC5A4C14A3B6F0A FOREIGN KEY (user_service_id) REFERENCES user_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_service_service ADD CONSTRAINT FK_3CC5A4C1ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('DROP SEQUENCE food_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE pay_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_entry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plate_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plates_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_per_entry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_service_id_seq CASCADE');
        $this->addSql('ALTER TABLE accommodation_service DROP CONSTRAINT FK_ADA9EE288F3692CD');
        $this->addSql('ALTER TABLE accommodation_service DROP CONSTRAINT FK_ADA9EE28ED5CA9E6');
        $this->addSql('ALTER TABLE accommodation_cottage DROP CONSTRAINT FK_24DAF8178F3692CD');
        $this->addSql('ALTER TABLE accommodation_cottage DROP CONSTRAINT FK_24DAF81717FF9E93');
        $this->addSql('ALTER TABLE entry_attraction_entry DROP CONSTRAINT FK_A4640609C76E041');
        $this->addSql('ALTER TABLE entry_attraction_entry DROP CONSTRAINT FK_A4640609BA364942');
        $this->addSql('ALTER TABLE entry_attraction_attraction DROP CONSTRAINT FK_81CAC90CC76E041');
        $this->addSql('ALTER TABLE entry_attraction_attraction DROP CONSTRAINT FK_81CAC90C3C216F9D');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398A5D24A7A');
        $this->addSql('ALTER TABLE pay DROP CONSTRAINT FK_FE8F223C79F37AE5');
        $this->addSql('ALTER TABLE payment_entry_entry DROP CONSTRAINT FK_59B72E0CFAF00B2A');
        $this->addSql('ALTER TABLE payment_entry_entry DROP CONSTRAINT FK_59B72E0CBA364942');
        $this->addSql('ALTER TABLE payment_entry_pay DROP CONSTRAINT FK_4E1A7372FAF00B2A');
        $this->addSql('ALTER TABLE payment_entry_pay DROP CONSTRAINT FK_4E1A7372918501AB');
        $this->addSql('ALTER TABLE plates_order DROP CONSTRAINT FK_1D63043D7942F140');
        $this->addSql('ALTER TABLE plates_order_plate DROP CONSTRAINT FK_8BAFE1BAFA254608');
        $this->addSql('ALTER TABLE plates_order_plate DROP CONSTRAINT FK_8BAFE1BADF66E98B');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2B2AB81DB');
        $this->addSql('ALTER TABLE service_per_entry_service DROP CONSTRAINT FK_991E6D1B21F3452D');
        $this->addSql('ALTER TABLE service_per_entry_service DROP CONSTRAINT FK_991E6D1BED5CA9E6');
        $this->addSql('ALTER TABLE service_per_entry_entry DROP CONSTRAINT FK_AB0B0B6321F3452D');
        $this->addSql('ALTER TABLE service_per_entry_entry DROP CONSTRAINT FK_AB0B0B63BA364942');
        $this->addSql('ALTER TABLE user_service_user DROP CONSTRAINT FK_C31C1EA74A3B6F0A');
        $this->addSql('ALTER TABLE user_service_user DROP CONSTRAINT FK_C31C1EA7A76ED395');
        $this->addSql('ALTER TABLE user_service_service DROP CONSTRAINT FK_3CC5A4C14A3B6F0A');
        $this->addSql('ALTER TABLE user_service_service DROP CONSTRAINT FK_3CC5A4C1ED5CA9E6');
        $this->addSql('DROP TABLE accommodation');
        $this->addSql('DROP TABLE accommodation_service');
        $this->addSql('DROP TABLE accommodation_cottage');
        $this->addSql('DROP TABLE attraction');
        $this->addSql('DROP TABLE cottage');
        $this->addSql('DROP TABLE entry');
        $this->addSql('DROP TABLE entry_attraction');
        $this->addSql('DROP TABLE entry_attraction_entry');
        $this->addSql('DROP TABLE entry_attraction_attraction');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE pay');
        $this->addSql('DROP TABLE payment_entry');
        $this->addSql('DROP TABLE payment_entry_entry');
        $this->addSql('DROP TABLE payment_entry_pay');
        $this->addSql('DROP TABLE plate');
        $this->addSql('DROP TABLE plates_order');
        $this->addSql('DROP TABLE plates_order_plate');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_per_entry');
        $this->addSql('DROP TABLE service_per_entry_service');
        $this->addSql('DROP TABLE service_per_entry_entry');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_service');
        $this->addSql('DROP TABLE user_service_user');
        $this->addSql('DROP TABLE user_service_service');
    }
}
