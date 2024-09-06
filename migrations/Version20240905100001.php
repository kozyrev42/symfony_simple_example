<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905100001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'создание таблицы tags';
    }
    public function up(Schema $schema): void
    {
        $this->addSql('
        CREATE TABLE tags (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL UNIQUE
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE tags');
    }
}
