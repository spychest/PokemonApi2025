<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251021080816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, pokedex_number INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_url VARCHAR(255) NOT NULL, sound_url VARCHAR(255) NOT NULL, generation INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_type (pokemon_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_B077296A2FE71C3E (pokemon_id), INDEX IDX_B077296AC54C8C93 (type_id), PRIMARY KEY(pokemon_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296A2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon_type DROP FOREIGN KEY FK_B077296A2FE71C3E');
        $this->addSql('ALTER TABLE pokemon_type DROP FOREIGN KEY FK_B077296AC54C8C93');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE pokemon_type');
        $this->addSql('DROP TABLE type');
    }
}
