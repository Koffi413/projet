<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304113305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE maisons ADD id_maisons_id INT DEFAULT NULL, ADD categorie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE maisons ADD CONSTRAINT FK_28F4DE5840FE453 FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_28F4DE5840FE453 ON maisons (id_categorie_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_1');
        $this->addSql('DROP INDEX id_maison ON reservation');
        $this->addSql('ALTER TABLE reservation DROP id_maison');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maisons DROP FOREIGN KEY FK_28F4DE5840FE453');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('ALTER TABLE reservation ADD id_maison INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_1 FOREIGN KEY (id_maison) REFERENCES maisons (id) ON UPDATE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX id_maison ON reservation (id_maison)');
        $this->addSql('DROP INDEX IDX_28F4DE5840FE453 ON maisons');
        $this->addSql('ALTER TABLE maisons DROP id_maisons_id, DROP categorie');
    }
}
