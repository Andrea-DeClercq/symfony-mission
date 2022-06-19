<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616185235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE reponses');
        $this->addSql('ALTER TABLE question CHANGE Sujet sujet LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponses (Id INT AUTO_INCREMENT NOT NULL, Sujet TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Utilisateur VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Date DATETIME NOT NULL, IdQuestion INT NOT NULL, INDEX IdQuestion (IdQuestion), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_1 FOREIGN KEY (IdQuestion) REFERENCES question (Id)');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE question CHANGE sujet Sujet TEXT NOT NULL');
    }
}
