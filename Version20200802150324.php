<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200802150324 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, plan_id INT DEFAULT NULL, login VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, active_to DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, restore_link VARCHAR(255) DEFAULT NULL, active INT DEFAULT 1 NOT NULL, role INT DEFAULT NULL, assets_opened INT DEFAULT NULL, assets_created INT DEFAULT NULL, created_at VARCHAR(255) DEFAULT NULL, deleted_at INT DEFAULT NULL, updated_at INT DEFAULT NULL, last_online INT DEFAULT NULL, password VARCHAR(255) NOT NULL, remember_token VARCHAR(255) DEFAULT NULL, INDEX restore_link (restore_link), INDEX plan_id (plan_id), INDEX last_online (last_online), UNIQUE INDEX email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, language_id INT NOT NULL, asset_id INT NOT NULL, result INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX language_id (language_id), INDEX user_id (user_id), INDEX asset_id (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, asset_id INT NOT NULL, word_id INT NOT NULL, translate_id INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX word_id (word_id), INDEX translate_id (translate_id), INDEX asset_id (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, language_id VARCHAR(50) DEFAULT NULL, word VARCHAR(255) NOT NULL, transcription VARCHAR(255) DEFAULT NULL, audio VARCHAR(255) DEFAULT NULL, sentence INT DEFAULT NULL, is_public INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_C3F1751161220EA6 (creator_id), INDEX IDX_C3F1751182F1BAF4 (language_id), INDEX word (word), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE example (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, text TEXT NOT NULL, value TEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX card_id (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translate (id INT AUTO_INCREMENT NOT NULL, word_id INT NOT NULL, value VARCHAR(255) NOT NULL, variant VARCHAR(255) DEFAULT NULL, form INT DEFAULT NULL, sentence INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX word_id_2 (word_id), INDEX word_id (word_id), INDEX `fulltext` (value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset (id INT AUTO_INCREMENT NOT NULL, language_id INT NOT NULL, title VARCHAR(255) NOT NULL, basic INT NOT NULL, type INT NOT NULL, level INT NOT NULL, favorite INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_2AF5A5C82F1BAF4 (language_id), INDEX id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, user_id BIGINT UNSIGNED NOT NULL, category_id INT NOT NULL, language_id INT DEFAULT NULL, title VARCHAR(200) NOT NULL, content LONGTEXT DEFAULT NULL, anonse TEXT DEFAULT NULL, status TINYINT(1) DEFAULT \'1\' NOT NULL, comment_status INT DEFAULT 1 NOT NULL, views BIGINT NOT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_5A8A6C8D12469DE2 (category_id), INDEX IDX_5A8A6C8D82F1BAF4 (language_id), INDEX post_name (title), INDEX post_author (user_id), INDEX id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, user_id INT DEFAULT NULL, text TEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_9474526C4B89032C (post_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, readed INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intro (id INT AUTO_INCREMENT NOT NULL, page VARCHAR(50) DEFAULT NULL, element VARCHAR(255) DEFAULT \'undefined\', intro TEXT DEFAULT NULL, position VARCHAR(255) DEFAULT \'false\', tooltipClass VARCHAR(255) DEFAULT NULL, sort INT DEFAULT 100, active INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, label VARCHAR(50) DEFAULT NULL, flag VARCHAR(50) DEFAULT NULL, INDEX name (name), INDEX id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE puzzle (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, text_value VARCHAR(255) NOT NULL, translate_value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE texts_users (id INT AUTO_INCREMENT NOT NULL, language_id VARCHAR(50) DEFAULT NULL, text_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_832A836E82F1BAF4 (language_id), INDEX user_id (user_id), INDEX text_id (text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_extras (id INT AUTO_INCREMENT NOT NULL, text_id INT DEFAULT NULL, orig VARCHAR(255) NOT NULL, extra VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX text_id (text_id, orig, extra), INDEX IDX_3317FC22698D3548 (text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE synonym (id INT AUTO_INCREMENT NOT NULL, word_id INT NOT NULL, synonym VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX word_id (word_id, synonym), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word_in_text (id INT AUTO_INCREMENT NOT NULL, text_id INT DEFAULT NULL, sentence_num INT NOT NULL, word VARCHAR(255) NOT NULL, orig VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX text_id (text_id, sentence_num, word), INDEX IDX_1B42EF50698D3548 (text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text (id INT AUTO_INCREMENT NOT NULL, language_id VARCHAR(50) DEFAULT NULL, level INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, text TEXT NOT NULL, translate TEXT NOT NULL, published INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX language_id (language_id), INDEX title (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plans (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, period VARCHAR(50) DEFAULT NULL, cost INT DEFAULT NULL, cost_per_month INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_access_tokens (id VARCHAR(100) NOT NULL, user_id INT DEFAULT NULL, client_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, scopes LONGTEXT DEFAULT NULL, revoked TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, expires_at DATETIME DEFAULT NULL, INDEX user_id_token_index (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_personal_access_clients (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX client_id_index (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_auth_codes (id VARCHAR(100) NOT NULL, user_id INT NOT NULL, client_id INT NOT NULL, scopes LONGTEXT DEFAULT NULL, revoked TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, plan_id INT DEFAULT NULL, user_id INT DEFAULT NULL, sum INT NOT NULL, status VARCHAR(50) DEFAULT NULL, notification_type VARCHAR(255) DEFAULT NULL, datetime VARCHAR(255) DEFAULT NULL, codepro VARCHAR(255) DEFAULT NULL, sender VARCHAR(255) DEFAULT NULL, sha1_hash VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX user_id (user_id), INDEX plan_id (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_clients (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, secret VARCHAR(100) NOT NULL, redirect LONGTEXT NOT NULL, personal_access_client TINYINT(1) NOT NULL, password_client TINYINT(1) NOT NULL, revoked TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX user_id_client_index (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_refresh_tokens (id VARCHAR(100) NOT NULL, access_token_id VARCHAR(100) NOT NULL, revoked TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, INDEX access_token_index (access_token_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9E899029B FOREIGN KEY (plan_id) REFERENCES plans (id)');
        $this->addSql('ALTER TABLE asset_user ADD CONSTRAINT FK_69F713815DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE asset_user ADD CONSTRAINT FK_69F71381A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE asset_user ADD CONSTRAINT FK_69F7138182F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3E357438D FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D35DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3649893AF FOREIGN KEY (translate_id) REFERENCES translate (id)');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F1751161220EA6 FOREIGN KEY (creator_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F1751182F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE example ADD CONSTRAINT FK_6EEC9B9F4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A106377E357438D FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE texts_users ADD CONSTRAINT FK_832A836E82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE texts_users ADD CONSTRAINT FK_832A836EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE texts_users ADD CONSTRAINT FK_832A836E698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE text_extras ADD CONSTRAINT FK_3317FC22698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE word_in_text ADD CONSTRAINT FK_1B42EF50698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEE899029B FOREIGN KEY (plan_id) REFERENCES plans (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE asset_user DROP FOREIGN KEY FK_69F71381A76ED395');
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F1751161220EA6');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE texts_users DROP FOREIGN KEY FK_832A836EA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE example DROP FOREIGN KEY FK_6EEC9B9F4ACC9A20');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3E357438D');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A106377E357438D');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3649893AF');
        $this->addSql('ALTER TABLE asset_user DROP FOREIGN KEY FK_69F713815DA1941');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D35DA1941');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE asset_user DROP FOREIGN KEY FK_69F7138182F1BAF4');
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F1751182F1BAF4');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C82F1BAF4');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D82F1BAF4');
        $this->addSql('ALTER TABLE texts_users DROP FOREIGN KEY FK_832A836E82F1BAF4');
        $this->addSql('ALTER TABLE text DROP FOREIGN KEY FK_3B8BA7C782F1BAF4');
        $this->addSql('ALTER TABLE texts_users DROP FOREIGN KEY FK_832A836E698D3548');
        $this->addSql('ALTER TABLE text_extras DROP FOREIGN KEY FK_3317FC22698D3548');
        $this->addSql('ALTER TABLE word_in_text DROP FOREIGN KEY FK_1B42EF50698D3548');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9E899029B');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEE899029B');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE asset_user');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE word');
        $this->addSql('DROP TABLE example');
        $this->addSql('DROP TABLE translate');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE intro');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE puzzle');
        $this->addSql('DROP TABLE texts_users');
        $this->addSql('DROP TABLE text_extras');
        $this->addSql('DROP TABLE synonym');
        $this->addSql('DROP TABLE word_in_text');
        $this->addSql('DROP TABLE text');
        $this->addSql('DROP TABLE plans');
        $this->addSql('DROP TABLE oauth_access_tokens');
        $this->addSql('DROP TABLE oauth_personal_access_clients');
        $this->addSql('DROP TABLE oauth_auth_codes');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE oauth_clients');
        $this->addSql('DROP TABLE oauth_refresh_tokens');
    }
}
