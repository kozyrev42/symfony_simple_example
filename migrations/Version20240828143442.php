<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828143442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'миграция добавляет колонку к таблице posts, создается внешний ключ связывающий таблицы posts и category';
    }
    public function up(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE posts
            ADD category_id INTEGER
        ');

        $this->addSql('
            ALTER TABLE posts
            ADD CONSTRAINT FK_posts_category_id
            FOREIGN KEY (category_id)
            REFERENCES category (id)
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE posts
            DROP CONSTRAINT FK_posts_category_id
        ');

        $this->addSql('
            ALTER TABLE posts
            DROP COLUMN category_id
        ');
    }
}
