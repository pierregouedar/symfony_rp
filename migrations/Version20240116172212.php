<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116172212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entity ADD strength INT NOT NULL, ADD dexterity INT NOT NULL, ADD constitution INT NOT NULL, ADD intelligence INT NOT NULL, ADD wisdom INT NOT NULL, ADD charisma INT NOT NULL, ADD mana INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64981257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64981257D5D ON user (entity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entity DROP strength, DROP dexterity, DROP constitution, DROP intelligence, DROP wisdom, DROP charisma, DROP mana');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64981257D5D');
        $this->addSql('DROP INDEX UNIQ_8D93D64981257D5D ON `user`');
        $this->addSql('ALTER TABLE `user` DROP entity_id');
    }
}
