<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816173349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, tarif_horaire DOUBLE PRECISION DEFAULT NULL, temps_reponse INT DEFAULT NULL, nombre_eleves INT DEFAULT NULL, premier_cours_offert TINYINT(1) DEFAULT NULL, lieu_cours VARCHAR(255) DEFAULT NULL, cours_en_ligne VARCHAR(255) DEFAULT NULL, cours_pack VARCHAR(255) DEFAULT NULL, tarif_en_ligne VARCHAR(255) DEFAULT NULL, temps_cours_offert VARCHAR(255) DEFAULT NULL, description_cours VARCHAR(700) DEFAULT NULL, question_faq1 VARCHAR(400) DEFAULT NULL, question_faq2 VARCHAR(400) DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annonce');
    }
}
