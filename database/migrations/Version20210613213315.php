<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210613213315 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX word ON term');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_C3F1751161220EA6');
        $this->addSql('ALTER TABLE term CHANGE word value VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX value ON term (value, creator_id)');
        $this->addSql('DROP INDEX idx_c3f1751161220ea6 ON term');
        $this->addSql('CREATE INDEX IDX_A50FE78D61220EA6 ON term (creator_id)');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_C3F1751161220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX value ON term');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78D61220EA6');
        $this->addSql('ALTER TABLE term CHANGE value word VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX word ON term (word, creator_id)');
        $this->addSql('DROP INDEX idx_a50fe78d61220ea6 ON term');
        $this->addSql('CREATE INDEX IDX_C3F1751161220EA6 ON term (creator_id)');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78D61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
    }
}
