<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210307121331 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test_result ADD language_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test_result ADD CONSTRAINT FK_84B3C63D82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('CREATE INDEX IDX_84B3C63D82F1BAF4 ON test_result (language_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test_result DROP FOREIGN KEY FK_84B3C63D82F1BAF4');
        $this->addSql('DROP INDEX IDX_84B3C63D82F1BAF4 ON test_result');
        $this->addSql('ALTER TABLE test_result DROP language_id');
    }
}
