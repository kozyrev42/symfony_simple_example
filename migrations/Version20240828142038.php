<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828142038 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE category');
    }
}
