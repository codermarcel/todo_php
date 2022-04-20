<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420082612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo_item ADD COLUMN is_finished BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE todo_item ADD COLUMN created_at INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo_item AS SELECT id, text FROM todo_item');
        $this->addSql('DROP TABLE todo_item');
        $this->addSql('CREATE TABLE todo_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO todo_item (id, text) SELECT id, text FROM __temp__todo_item');
        $this->addSql('DROP TABLE __temp__todo_item');
    }
}
