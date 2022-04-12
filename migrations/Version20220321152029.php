<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321152029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634D2235D39');
        $this->addSql('DROP INDEX IDX_497DD634D2235D39 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP tache_id');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075D4E271E1');
        $this->addSql('DROP INDEX IDX_93872075D4E271E1 ON tache');
        $this->addSql('ALTER TABLE tache ADD projet_id INT NOT NULL, ADD categorie_id INT NOT NULL, DROP projet_id_id, DROP nom');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075C18272 FOREIGN KEY (projet_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_93872075C18272 ON tache (projet_id)');
        $this->addSql('CREATE INDEX IDX_93872075BCF5E72D ON tache (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD tache_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('CREATE INDEX IDX_497DD634D2235D39 ON categorie (tache_id)');
        $this->addSql('ALTER TABLE client CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE agence agence VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE note note VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project CHANGE nomprojet nomprojet VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE numero numero VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE equipe equipe VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE note note VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE annee annee VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075C18272');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075BCF5E72D');
        $this->addSql('DROP INDEX IDX_93872075C18272 ON tache');
        $this->addSql('DROP INDEX IDX_93872075BCF5E72D ON tache');
        $this->addSql('ALTER TABLE tache ADD projet_id_id INT DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP projet_id, DROP categorie_id');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075D4E271E1 FOREIGN KEY (projet_id_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_93872075D4E271E1 ON tache (projet_id_id)');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
