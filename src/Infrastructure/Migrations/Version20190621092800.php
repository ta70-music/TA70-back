<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190621092800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE music_user');
        $this->addSql('ALTER TABLE login_history CHANGE user_id user_id INT DEFAULT NULL, CHANGE api_token api_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE salon CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE album ADD music_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43399BBB13 FOREIGN KEY (music_id) REFERENCES music (id)');
        $this->addSql('CREATE INDEX IDX_39986E43399BBB13 ON album (music_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE user_id user_id INT DEFAULT NULL, CHANGE salon_id salon_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE music_user (music_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D9A2D2D2399BBB13 (music_id), INDEX IDX_D9A2D2D2A76ED395 (user_id), PRIMARY KEY(music_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE music_user ADD CONSTRAINT FK_D9A2D2D2399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_user ADD CONSTRAINT FK_D9A2D2D2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43399BBB13');
        $this->addSql('DROP INDEX IDX_39986E43399BBB13 ON album');
        $this->addSql('ALTER TABLE album DROP music_id');
        $this->addSql('ALTER TABLE login_history CHANGE user_id user_id INT DEFAULT NULL, CHANGE api_token api_token VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE message CHANGE user_id user_id INT DEFAULT NULL, CHANGE salon_id salon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE salon CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
