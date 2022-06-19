<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617174113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question CHANGE Sujet sujet LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY reponses_ibfk_1');
        $this->addSql('DROP INDEX IdQuestion ON reponses');
        $this->addSql('ALTER TABLE reponses CHANGE Sujet sujet LONGTEXT NOT NULL, CHANGE IdQuestion id_question INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE question CHANGE sujet Sujet TEXT NOT NULL');
        $this->addSql('ALTER TABLE reponses CHANGE sujet Sujet TEXT NOT NULL, CHANGE id_question IdQuestion INT NOT NULL');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT reponses_ibfk_1 FOREIGN KEY (IdQuestion) REFERENCES question (Id)');
        $this->addSql('CREATE INDEX IdQuestion ON reponses (IdQuestion)');
    }
}
