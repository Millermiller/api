<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20211002185403 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `order` (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', payment_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', service_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F52993984C3A3BB (payment_id), UNIQUE INDEX UNIQ_F5299398ED5CA9E6 (service_id), INDEX user (user_id), INDEX payment (payment_id), INDEX service_id (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id INT DEFAULT NULL, amount NUMERIC(10, 2) NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX user (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, period INT NOT NULL, cost NUMERIC(10, 2) NOT NULL, cost_per_month NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', item_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type_value VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E19D9AD2126F525E (item_id), INDEX type (type_value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE active_to raised_to DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984C3A3BB');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398ED5CA9E6');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE service');
        $this->addSql('ALTER TABLE user CHANGE raised_to active_to DATETIME DEFAULT NULL');
    }
}
