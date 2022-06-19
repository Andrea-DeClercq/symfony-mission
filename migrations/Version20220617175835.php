<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617175835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_question_id INT NOT NULL, reponse LONGTEXT NOT NULL, utilisateur VARCHAR(20) NOT NULL, date DATETIME NOT NULL, INDEX IDX_5FB6DEC76353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
        $this->addSql('DROP TABLE reponses');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponses (Id INT AUTO_INCREMENT NOT NULL, reponse TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Utilisateur VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Date DATETIME NOT NULL, PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE reponse');
    }
}
