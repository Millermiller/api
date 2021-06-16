<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210616165852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_C3F1751161220EA6');
        $this->addSql('DROP INDEX IDX_A50FE78D61220EA6 ON term');
        $this->addSql('DROP INDEX value ON term');
        $this->addSql('ALTER TABLE term DROP audio, CHANGE creator_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A50FE78DA76ED395 ON term (user_id)');
        $this->addSql('CREATE INDEX value ON term (value, user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78DA76ED395');
        $this->addSql('DROP INDEX IDX_A50FE78DA76ED395 ON term');
        $this->addSql('DROP INDEX value ON term');
        $this->addSql('ALTER TABLE term ADD audio VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE user_id creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_C3F1751161220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A50FE78D61220EA6 ON term (creator_id)');
        $this->addSql('CREATE INDEX value ON term (value, creator_id)');
    }
}
