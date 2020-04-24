<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424144117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE opportunity (id INT AUTO_INCREMENT NOT NULL, published_by_id INT NOT NULL, domain VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, published_on DATE NOT NULL, approved TINYINT(1) NOT NULL, INDEX IDX_8389C3D75B075477 (published_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opportunity ADD CONSTRAINT FK_8389C3D75B075477 FOREIGN KEY (published_by_id) REFERENCES member (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE opportunity');
    }
}
