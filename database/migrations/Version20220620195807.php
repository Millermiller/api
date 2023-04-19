<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20220620195807 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE asset_cards DROP FOREIGN KEY FK_919976BA5DA1941');
        $this->addSql('ALTER TABLE test_result DROP FOREIGN KEY FK_84B3C63D5DA1941');
        $this->addSql('ALTER TABLE test_result DROP FOREIGN KEY FK_84B3C63DA76ED395');

        $this->addSql('ALTER TABLE asset CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');

        $this->addSql('ALTER TABLE asset_cards CHANGE asset_id asset_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE test_result CHANGE asset_id asset_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');

        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63D5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE asset_cards ADD CONSTRAINT FK_919976BA5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63D5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');

        $this->addSql('ALTER TABLE asset CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE asset_cards CHANGE asset_id asset_id INT NOT NULL');

        $this->addSql('ALTER TABLE test_result DROP FOREIGN KEY FK_84B3C63D5DA1941');
        $this->addSql('ALTER TABLE test_result DROP FOREIGN KEY FK_84B3C63DA76ED395');
        $this->addSql('ALTER TABLE test_result CHANGE asset_id asset_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63D5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
