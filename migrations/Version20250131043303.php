<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250131043303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE food_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plates_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE food (id INT NOT NULL, payment DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plate (id INT NOT NULL, name VARCHAR(30) NOT NULL, description TEXT NOT NULL, value INT NOT NULL, stock INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plates_order (id INT NOT NULL, nro_order_id INT NOT NULL, nro_plates INT NOT NULL, tplate VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1D63043D7942F140 ON plates_order (nro_order_id)');
        $this->addSql('CREATE TABLE plates_order_plate (plates_order_id INT NOT NULL, plate_id INT NOT NULL, PRIMARY KEY(plates_order_id, plate_id))');
        $this->addSql('CREATE INDEX IDX_8BAFE1BAFA254608 ON plates_order_plate (plates_order_id)');
        $this->addSql('CREATE INDEX IDX_8BAFE1BADF66E98B ON plates_order_plate (plate_id)');
        $this->addSql('ALTER TABLE plates_order ADD CONSTRAINT FK_1D63043D7942F140 FOREIGN KEY (nro_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plates_order_plate ADD CONSTRAINT FK_8BAFE1BAFA254608 FOREIGN KEY (plates_order_id) REFERENCES plates_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plates_order_plate ADD CONSTRAINT FK_8BAFE1BADF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD service_asociate_id INT NOT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2B2AB81DB FOREIGN KEY (service_asociate_id) REFERENCES food (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E19D9AD2B2AB81DB ON service (service_asociate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2B2AB81DB');
        $this->addSql('DROP SEQUENCE food_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE plate_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plates_order_id_seq CASCADE');
        $this->addSql('ALTER TABLE plates_order DROP CONSTRAINT FK_1D63043D7942F140');
        $this->addSql('ALTER TABLE plates_order_plate DROP CONSTRAINT FK_8BAFE1BAFA254608');
        $this->addSql('ALTER TABLE plates_order_plate DROP CONSTRAINT FK_8BAFE1BADF66E98B');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE plate');
        $this->addSql('DROP TABLE plates_order');
        $this->addSql('DROP TABLE plates_order_plate');
        $this->addSql('DROP INDEX IDX_E19D9AD2B2AB81DB');
        $this->addSql('ALTER TABLE service DROP service_asociate_id');
    }
}
