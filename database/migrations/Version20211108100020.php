<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20211108100020 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FD82F1BAF4');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FD82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE puzzle DROP FOREIGN KEY FK_22A6DFDF82F1BAF4');
        $this->addSql('ALTER TABLE puzzle ADD CONSTRAINT FK_22A6DFDF82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE text DROP FOREIGN KEY FK_3B8BA7C782F1BAF4');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A10637782F1BAF4');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A10637782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FD82F1BAF4');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FD82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE puzzle DROP FOREIGN KEY FK_22A6DFDF82F1BAF4');
        $this->addSql('ALTER TABLE puzzle ADD CONSTRAINT FK_22A6DFDF82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE text DROP FOREIGN KEY FK_3B8BA7C782F1BAF4');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A10637782F1BAF4');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A10637782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
    }
}
