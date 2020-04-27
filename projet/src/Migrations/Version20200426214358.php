<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426214358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE927E3C61F9');
        $this->addSql('ALTER TABLE opportunity DROP FOREIGN KEY FK_8389C3D75B075477');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment ADD user_id INT DEFAULT NULL, DROP author_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('DROP INDEX UNIQ_B66FFE927E3C61F9 ON cv');
        $this->addSql('ALTER TABLE cv DROP owner_id');
        $this->addSql('ALTER TABLE internship ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE job ADD name VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_8389C3D75B075477 ON opportunity');
        $this->addSql('ALTER TABLE opportunity ADD user_id INT DEFAULT NULL, CHANGE published_by_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE opportunity ADD CONSTRAINT FK_8389C3D712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE opportunity ADD CONSTRAINT FK_8389C3D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8389C3D712469DE2 ON opportunity (category_id)');
        $this->addSql('CREATE INDEX IDX_8389C3D7A76ED395 ON opportunity (user_id)');
        $this->addSql('ALTER TABLE training ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment ADD author_id INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('ALTER TABLE cv ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE927E3C61F9 FOREIGN KEY (owner_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B66FFE927E3C61F9 ON cv (owner_id)');
        $this->addSql('ALTER TABLE internship DROP name');
        $this->addSql('ALTER TABLE job DROP name');
        $this->addSql('ALTER TABLE opportunity DROP FOREIGN KEY FK_8389C3D712469DE2');
        $this->addSql('ALTER TABLE opportunity DROP FOREIGN KEY FK_8389C3D7A76ED395');
        $this->addSql('DROP INDEX IDX_8389C3D712469DE2 ON opportunity');
        $this->addSql('DROP INDEX IDX_8389C3D7A76ED395 ON opportunity');
        $this->addSql('ALTER TABLE opportunity DROP user_id, CHANGE category_id published_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE opportunity ADD CONSTRAINT FK_8389C3D75B075477 FOREIGN KEY (published_by_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_8389C3D75B075477 ON opportunity (published_by_id)');
        $this->addSql('ALTER TABLE training DROP name');
    }
}
