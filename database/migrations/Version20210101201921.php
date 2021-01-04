<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210101201921 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE text_user (user_id INT NOT NULL, text_id INT NOT NULL, INDEX IDX_8AEDA87CA76ED395 (user_id), INDEX IDX_8AEDA87C698D3548 (text_id), PRIMARY KEY(user_id, text_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset_user (user_id INT NOT NULL, asset_id INT NOT NULL, INDEX IDX_69F71381A76ED395 (user_id), INDEX IDX_69F713815DA1941 (asset_id), PRIMARY KEY(user_id, asset_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE result_text (id INT AUTO_INCREMENT NOT NULL, text_id INT NOT NULL, language_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_ABB0BC8982F1BAF4 (language_id), INDEX user_id (user_id), INDEX text_id (text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE text_user ADD CONSTRAINT FK_8AEDA87CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text_user ADD CONSTRAINT FK_8AEDA87C698D3548 FOREIGN KEY (text_id) REFERENCES text (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asset_user ADD CONSTRAINT FK_69F71381A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asset_user ADD CONSTRAINT FK_69F713815DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE result_text ADD CONSTRAINT FK_ABB0BC8982F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE result_text ADD CONSTRAINT FK_ABB0BC89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE result_text ADD CONSTRAINT FK_ABB0BC89698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE result_asset DROP language_id, CHANGE asset_id asset_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE result_asset ADD CONSTRAINT FK_935B0DD05DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE result_asset ADD CONSTRAINT FK_935B0DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX user_id ON result_asset (user_id)');
        $this->addSql('CREATE INDEX asset_id ON result_asset (asset_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE text_user');
        $this->addSql('DROP TABLE asset_user');
        $this->addSql('DROP TABLE result_text');
        $this->addSql('ALTER TABLE result_asset DROP FOREIGN KEY FK_935B0DD05DA1941');
        $this->addSql('ALTER TABLE result_asset DROP FOREIGN KEY FK_935B0DD0A76ED395');
        $this->addSql('DROP INDEX user_id ON result_asset');
        $this->addSql('DROP INDEX asset_id ON result_asset');
        $this->addSql('ALTER TABLE result_asset ADD language_id INT NOT NULL, CHANGE asset_id asset_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
