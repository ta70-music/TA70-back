<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190618093247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_user (music_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D9A2D2D2399BBB13 (music_id), INDEX IDX_D9A2D2D2A76ED395 (user_id), PRIMARY KEY(music_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_listen_history (music_id INT NOT NULL, listen_history_id INT NOT NULL, INDEX IDX_8C3FA208399BBB13 (music_id), INDEX IDX_8C3FA208EBBCD2AD (listen_history_id), PRIMARY KEY(music_id, listen_history_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE albums (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE albums_music (albums_id INT NOT NULL, music_id INT NOT NULL, INDEX IDX_9D0CA089ECBB55AF (albums_id), INDEX IDX_9D0CA089399BBB13 (music_id), PRIMARY KEY(albums_id, music_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category VARCHAR(255) NOT NULL, INDEX IDX_F268F417A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listen_history (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listen_history_user (listen_history_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_978A5A3FEBBCD2AD (listen_history_id), INDEX IDX_978A5A3FA76ED395 (user_id), PRIMARY KEY(listen_history_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user (user_source INT NOT NULL, user_target INT NOT NULL, INDEX IDX_F7129A803AD8644E (user_source), INDEX IDX_F7129A80233D34C1 (user_target), PRIMARY KEY(user_source, user_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_history (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, research VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_history_user (search_history_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_916A71EBC6B3B498 (search_history_id), INDEX IDX_916A71EBA76ED395 (user_id), PRIMARY KEY(search_history_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login_history (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, timestamp DATETIME NOT NULL, success TINYINT(1) NOT NULL, ip VARCHAR(255) NOT NULL, INDEX IDX_37976E36A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_music (category_id INT NOT NULL, music_id INT NOT NULL, INDEX IDX_25616D0312469DE2 (category_id), INDEX IDX_25616D03399BBB13 (music_id), PRIMARY KEY(category_id, music_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, salon_id INT DEFAULT NULL, content VARCHAR(5000) NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), INDEX IDX_B6BD307F4C91BDE4 (salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE music_user ADD CONSTRAINT FK_D9A2D2D2399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_user ADD CONSTRAINT FK_D9A2D2D2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_listen_history ADD CONSTRAINT FK_8C3FA208399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_listen_history ADD CONSTRAINT FK_8C3FA208EBBCD2AD FOREIGN KEY (listen_history_id) REFERENCES listen_history (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE albums_music ADD CONSTRAINT FK_9D0CA089ECBB55AF FOREIGN KEY (albums_id) REFERENCES albums (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE albums_music ADD CONSTRAINT FK_9D0CA089399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F417A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE listen_history_user ADD CONSTRAINT FK_978A5A3FEBBCD2AD FOREIGN KEY (listen_history_id) REFERENCES listen_history (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listen_history_user ADD CONSTRAINT FK_978A5A3FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_history_user ADD CONSTRAINT FK_916A71EBC6B3B498 FOREIGN KEY (search_history_id) REFERENCES search_history (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_history_user ADD CONSTRAINT FK_916A71EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE login_history ADD CONSTRAINT FK_37976E36A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category_music ADD CONSTRAINT FK_25616D0312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_music ADD CONSTRAINT FK_25616D03399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE music_user DROP FOREIGN KEY FK_D9A2D2D2399BBB13');
        $this->addSql('ALTER TABLE music_listen_history DROP FOREIGN KEY FK_8C3FA208399BBB13');
        $this->addSql('ALTER TABLE albums_music DROP FOREIGN KEY FK_9D0CA089399BBB13');
        $this->addSql('ALTER TABLE category_music DROP FOREIGN KEY FK_25616D03399BBB13');
        $this->addSql('ALTER TABLE albums_music DROP FOREIGN KEY FK_9D0CA089ECBB55AF');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4C91BDE4');
        $this->addSql('ALTER TABLE music_listen_history DROP FOREIGN KEY FK_8C3FA208EBBCD2AD');
        $this->addSql('ALTER TABLE listen_history_user DROP FOREIGN KEY FK_978A5A3FEBBCD2AD');
        $this->addSql('ALTER TABLE music_user DROP FOREIGN KEY FK_D9A2D2D2A76ED395');
        $this->addSql('ALTER TABLE salon DROP FOREIGN KEY FK_F268F417A76ED395');
        $this->addSql('ALTER TABLE listen_history_user DROP FOREIGN KEY FK_978A5A3FA76ED395');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A803AD8644E');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A80233D34C1');
        $this->addSql('ALTER TABLE search_history_user DROP FOREIGN KEY FK_916A71EBA76ED395');
        $this->addSql('ALTER TABLE login_history DROP FOREIGN KEY FK_37976E36A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE search_history_user DROP FOREIGN KEY FK_916A71EBC6B3B498');
        $this->addSql('ALTER TABLE category_music DROP FOREIGN KEY FK_25616D0312469DE2');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE music_user');
        $this->addSql('DROP TABLE music_listen_history');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE albums_music');
        $this->addSql('DROP TABLE salon');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE listen_history');
        $this->addSql('DROP TABLE listen_history_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('DROP TABLE search_history');
        $this->addSql('DROP TABLE search_history_user');
        $this->addSql('DROP TABLE login_history');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_music');
        $this->addSql('DROP TABLE message');
    }
}
