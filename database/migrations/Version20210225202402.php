<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210225202402 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE test_result (id INT AUTO_INCREMENT NOT NULL, asset_id INT DEFAULT NULL, user_id INT DEFAULT NULL, completed TINYINT(1) NOT NULL, percent INT NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX user_id (user_id), INDEX asset_id (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63D5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE result_asset');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE result_asset (id INT AUTO_INCREMENT NOT NULL, asset_id INT DEFAULT NULL, user_id INT DEFAULT NULL, result INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX user_id (user_id), INDEX asset_id (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE result_asset ADD CONSTRAINT FK_935B0DD05DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE result_asset ADD CONSTRAINT FK_935B0DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE test_result');
    }
}
