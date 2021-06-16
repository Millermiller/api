<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210613212635 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDE357438D');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A106377E357438D');
        $this->addSql('ALTER TABLE word RENAME TO term');
        $this->addSql('DROP INDEX word_id ON cards');
        $this->addSql('ALTER TABLE cards CHANGE word_id term_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDE2C35FC FOREIGN KEY (term_id) REFERENCES term (id)');
        $this->addSql('CREATE INDEX term_id ON cards (term_id)');
        $this->addSql('DROP INDEX word_id_2 ON translate');
        $this->addSql('DROP INDEX word_id ON translate');
        $this->addSql('ALTER TABLE translate CHANGE word_id term_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A106377E2C35FC FOREIGN KEY (term_id) REFERENCES term (id)');
        $this->addSql('CREATE INDEX term_id ON translate (term_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDE2C35FC');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A106377E2C35FC');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F1751161220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE term RENAME TO word');
        $this->addSql('DROP INDEX term_id ON cards');
        $this->addSql('ALTER TABLE cards CHANGE term_id word_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDE357438D FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('CREATE INDEX word_id ON cards (word_id)');
        $this->addSql('DROP INDEX term_id ON translate');
        $this->addSql('ALTER TABLE translate CHANGE term_id word_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A106377E357438D FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('CREATE INDEX word_id_2 ON translate (word_id)');
        $this->addSql('CREATE INDEX word_id ON translate (word_id)');
    }
}
