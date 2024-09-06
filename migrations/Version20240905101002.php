<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905101002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'создание таблицы tags';
    }
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE tags_to_post (
            post_id INTEGER NOT NULL,
            tag_id INTEGER NOT NULL,
            PRIMARY KEY(post_id, tag_id),
            FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE,
            FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE 
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE tags_to_post');
    }
}
