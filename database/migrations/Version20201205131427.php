<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20201205131427 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE permission_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_BB4729B65E237E06 (name), UNIQUE INDEX UNIQ_BB4729B6989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE permission ADD permission_group_id INT DEFAULT NULL, DROP pgroup');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AAB6C0CF1 FOREIGN KEY (permission_group_id) REFERENCES permission_group (id)');
        $this->addSql('CREATE INDEX IDX_E04992AAB6C0CF1 ON permission (permission_group_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE permission DROP FOREIGN KEY FK_E04992AAB6C0CF1');
        $this->addSql('DROP TABLE permission_group');
        $this->addSql('DROP INDEX IDX_E04992AAB6C0CF1 ON permission');
        $this->addSql('ALTER TABLE permission ADD pgroup LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP permission_group_id');
    }
}
