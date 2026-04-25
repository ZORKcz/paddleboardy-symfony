<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260423120356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresa (id INT AUTO_INCREMENT NOT NULL, ulice VARCHAR(100) NOT NULL, mesto VARCHAR(100) NOT NULL, psc VARCHAR(10) NOT NULL, zeme VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE platba (id INT AUTO_INCREMENT NOT NULL, castka NUMERIC(10, 2) NOT NULL, datum_platby DATE NOT NULL, variabilni_symbol VARCHAR(10) NOT NULL, rezervace_id INT NOT NULL, UNIQUE INDEX UNIQ_5B3E3E2F8CB78B49 (rezervace_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE polozka_rezervace (id INT AUTO_INCREMENT NOT NULL, mnozstvi INT NOT NULL, skutecna_cena NUMERIC(10, 2) NOT NULL, rezervace_id INT NOT NULL, skladova_polozka_id INT NOT NULL, INDEX IDX_667850798CB78B49 (rezervace_id), INDEX IDX_66785079EB1B61AE (skladova_polozka_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE produkt (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(150) NOT NULL, popis VARCHAR(255) DEFAULT NULL, doporucena_cena NUMERIC(10, 2) NOT NULL, foto_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE rezervace (id INT AUTO_INCREMENT NOT NULL, datum_od DATE NOT NULL, datum_do DATE NOT NULL, celkova_cena NUMERIC(10, 2) DEFAULT NULL, datum_vytvoreni DATE NOT NULL, zakaznik_id INT NOT NULL, stav_rezervace_id INT NOT NULL, INDEX IDX_472D00E510BBF3DA (zakaznik_id), INDEX IDX_472D00E5C566524E (stav_rezervace_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE skladova_polozka (id INT AUTO_INCREMENT NOT NULL, mnozstvi_skladem INT NOT NULL, seriove_cislo VARCHAR(100) DEFAULT NULL, gps_lokator_id VARCHAR(50) DEFAULT NULL, poznamka VARCHAR(255) DEFAULT NULL, produkt_id INT NOT NULL, stanice_id INT NOT NULL, stav_polozky_id INT NOT NULL, INDEX IDX_E834183E75F42D9B (produkt_id), INDEX IDX_E834183EF0E21BB5 (stanice_id), INDEX IDX_E834183E8420589B (stav_polozky_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE stanice (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(100) NOT NULL, gps_pozice VARCHAR(50) NOT NULL, servisni_telefon VARCHAR(20) NOT NULL, region_id INT NOT NULL, adresa_id INT NOT NULL, INDEX IDX_9BFAD9CE98260155 (region_id), INDEX IDX_9BFAD9CE7E9666B8 (adresa_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE stav_rezervace (id INT AUTO_INCREMENT NOT NULL, kod VARCHAR(50) NOT NULL, popis VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE stav_skladove_polozky (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(20) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE vydej (id INT AUTO_INCREMENT NOT NULL, datum_cas_vydeje DATE NOT NULL, datum_cas_vraceni DATE DEFAULT NULL, poznamka VARCHAR(255) DEFAULT NULL, polozka_rezervace_id INT NOT NULL, INDEX IDX_5CB4793CD90432D3 (polozka_rezervace_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE zakaznik (id INT AUTO_INCREMENT NOT NULL, jmeno VARCHAR(100) NOT NULL, prijmeni VARCHAR(100) NOT NULL, email VARCHAR(50) NOT NULL, telefon VARCHAR(20) NOT NULL, souhlas_s_podminkami TINYINT NOT NULL, poznamka VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE platba ADD CONSTRAINT FK_5B3E3E2F8CB78B49 FOREIGN KEY (rezervace_id) REFERENCES rezervace (id)');
        $this->addSql('ALTER TABLE polozka_rezervace ADD CONSTRAINT FK_667850798CB78B49 FOREIGN KEY (rezervace_id) REFERENCES rezervace (id)');
        $this->addSql('ALTER TABLE polozka_rezervace ADD CONSTRAINT FK_66785079EB1B61AE FOREIGN KEY (skladova_polozka_id) REFERENCES skladova_polozka (id)');
        $this->addSql('ALTER TABLE rezervace ADD CONSTRAINT FK_472D00E510BBF3DA FOREIGN KEY (zakaznik_id) REFERENCES zakaznik (id)');
        $this->addSql('ALTER TABLE rezervace ADD CONSTRAINT FK_472D00E5C566524E FOREIGN KEY (stav_rezervace_id) REFERENCES stav_rezervace (id)');
        $this->addSql('ALTER TABLE skladova_polozka ADD CONSTRAINT FK_E834183E75F42D9B FOREIGN KEY (produkt_id) REFERENCES produkt (id)');
        $this->addSql('ALTER TABLE skladova_polozka ADD CONSTRAINT FK_E834183EF0E21BB5 FOREIGN KEY (stanice_id) REFERENCES stanice (id)');
        $this->addSql('ALTER TABLE skladova_polozka ADD CONSTRAINT FK_E834183E8420589B FOREIGN KEY (stav_polozky_id) REFERENCES stav_skladove_polozky (id)');
        $this->addSql('ALTER TABLE stanice ADD CONSTRAINT FK_9BFAD9CE98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE stanice ADD CONSTRAINT FK_9BFAD9CE7E9666B8 FOREIGN KEY (adresa_id) REFERENCES adresa (id)');
        $this->addSql('ALTER TABLE vydej ADD CONSTRAINT FK_5CB4793CD90432D3 FOREIGN KEY (polozka_rezervace_id) REFERENCES polozka_rezervace (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE platba DROP FOREIGN KEY FK_5B3E3E2F8CB78B49');
        $this->addSql('ALTER TABLE polozka_rezervace DROP FOREIGN KEY FK_667850798CB78B49');
        $this->addSql('ALTER TABLE polozka_rezervace DROP FOREIGN KEY FK_66785079EB1B61AE');
        $this->addSql('ALTER TABLE rezervace DROP FOREIGN KEY FK_472D00E510BBF3DA');
        $this->addSql('ALTER TABLE rezervace DROP FOREIGN KEY FK_472D00E5C566524E');
        $this->addSql('ALTER TABLE skladova_polozka DROP FOREIGN KEY FK_E834183E75F42D9B');
        $this->addSql('ALTER TABLE skladova_polozka DROP FOREIGN KEY FK_E834183EF0E21BB5');
        $this->addSql('ALTER TABLE skladova_polozka DROP FOREIGN KEY FK_E834183E8420589B');
        $this->addSql('ALTER TABLE stanice DROP FOREIGN KEY FK_9BFAD9CE98260155');
        $this->addSql('ALTER TABLE stanice DROP FOREIGN KEY FK_9BFAD9CE7E9666B8');
        $this->addSql('ALTER TABLE vydej DROP FOREIGN KEY FK_5CB4793CD90432D3');
        $this->addSql('DROP TABLE adresa');
        $this->addSql('DROP TABLE platba');
        $this->addSql('DROP TABLE polozka_rezervace');
        $this->addSql('DROP TABLE produkt');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE rezervace');
        $this->addSql('DROP TABLE skladova_polozka');
        $this->addSql('DROP TABLE stanice');
        $this->addSql('DROP TABLE stav_rezervace');
        $this->addSql('DROP TABLE stav_skladove_polozky');
        $this->addSql('DROP TABLE vydej');
        $this->addSql('DROP TABLE zakaznik');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
