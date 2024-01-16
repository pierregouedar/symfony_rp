<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115190444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entity (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, personnal_goals VARCHAR(1024) NOT NULL, story VARCHAR(1024) NOT NULL, personality VARCHAR(255) NOT NULL, advantages VARCHAR(255) NOT NULL, penalty VARCHAR(255) NOT NULL, hp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell (id INT AUTO_INCREMENT NOT NULL, entity_id INT DEFAULT NULL, damage_type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, damage INT NOT NULL, spell_range DOUBLE PRECISION NOT NULL, mana_amount INT NOT NULL, INDEX IDX_D03FCD8D81257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, entity_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, damage INT NOT NULL, weapon_range DOUBLE PRECISION NOT NULL, capacity INT NOT NULL, INDEX IDX_6933A7E681257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE spell ADD CONSTRAINT FK_D03FCD8D81257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E681257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spell DROP FOREIGN KEY FK_D03FCD8D81257D5D');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E681257D5D');
        $this->addSql('DROP TABLE entity');
        $this->addSql('DROP TABLE spell');
        $this->addSql('DROP TABLE weapon');
    }
}
