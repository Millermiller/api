<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210815154535 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDE357438D');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A106377E357438D');
        $this->addSql('ALTER TABLE synonym DROP FOREIGN KEY FK_A6315EC8E357438D');
        $this->addSql('CREATE TABLE term (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, morph VARCHAR(255) DEFAULT NULL, frequency DOUBLE PRECISION DEFAULT NULL, sentence TINYINT(1) DEFAULT NULL, is_public TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_A50FE78DA76ED395 (user_id), INDEX value (value, user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text__dictionary (id INT AUTO_INCREMENT NOT NULL, text_id INT DEFAULT NULL, sentence_num INT NOT NULL, object VARCHAR(255) NOT NULL, value VARCHAR(255) DEFAULT NULL, coordinates LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX text_id (text_id, sentence_num, object), INDEX IDX_1B42EF50698D3548 (text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text__passing (id INT AUTO_INCREMENT NOT NULL, text_id INT DEFAULT NULL, language_id INT DEFAULT NULL, user_id INT DEFAULT NULL, completed TINYINT(1) NOT NULL, percent INT NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D8F069D582F1BAF4 (language_id), INDEX user_id (user_id), INDEX text_id (text_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text__synonym (id INT AUTO_INCREMENT NOT NULL, dictionary_item_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_643B33A7F30A40FF (dictionary_item_id), INDEX word_id (dictionary_item_id, value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE text__dictionary ADD CONSTRAINT FK_6CAD950D698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE text__passing ADD CONSTRAINT FK_D8F069D5698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE text__passing ADD CONSTRAINT FK_D8F069D582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE text__passing ADD CONSTRAINT FK_D8F069D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE text__synonym ADD CONSTRAINT FK_643B33A7F30A40FF FOREIGN KEY (dictionary_item_id) REFERENCES text__dictionary (id)');
        $this->addSql('DROP TABLE result_text');
        $this->addSql('DROP TABLE synonym');
        $this->addSql('DROP TABLE word');
        $this->addSql('DROP TABLE word_in_text');
        $this->addSql('ALTER TABLE asset DROP basic, DROP favorite, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX word_id ON cards');
        $this->addSql('ALTER TABLE cards CHANGE created_at created_at DATETIME NOT NULL, CHANGE word_id term_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDE2C35FC FOREIGN KEY (term_id) REFERENCES term (id)');
        $this->addSql('CREATE INDEX term_id ON cards (term_id)');
        $this->addSql('ALTER TABLE category CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE post_id post_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE intro CHANGE page page VARCHAR(255) NOT NULL, CHANGE target target VARCHAR(255) DEFAULT NULL, CHANGE content content LONGTEXT NOT NULL, CHANGE position position VARCHAR(255) NOT NULL, CHANGE sort sort INT DEFAULT 0 NOT NULL, CHANGE active active TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE language CHANGE flag flag VARCHAR(255) NOT NULL, CHANGE letter letter VARCHAR(5) NOT NULL');
        $this->addSql('ALTER TABLE log CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE name name VARCHAR(255) NOT NULL, CHANGE message message LONGTEXT NOT NULL, CHANGE readed readed TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE permission CHANGE name name VARCHAR(255) NOT NULL, CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE permission_group CHANGE name name VARCHAR(255) NOT NULL, CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE status status TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE comment_status comment_status TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE views views INT DEFAULT 0 NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE name name VARCHAR(255) NOT NULL, CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE settings ADD description LONGTEXT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE test_result CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE text CHANGE published published TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('DROP INDEX text_id ON text_extras');
        $this->addSql('ALTER TABLE text_extras ADD object VARCHAR(255) NOT NULL, ADD value VARCHAR(255) NOT NULL, DROP orig, DROP extra');
        $this->addSql('CREATE INDEX text_id ON text_extras (text_id, object, value)');
        $this->addSql('DROP INDEX word_id_2 ON translate');
        $this->addSql('DROP INDEX word_id ON translate');
        $this->addSql('ALTER TABLE translate CHANGE sentence sentence TINYINT(1) NOT NULL, CHANGE word_id term_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A106377E2C35FC FOREIGN KEY (term_id) REFERENCES term (id)');
        $this->addSql('CREATE INDEX term_id ON translate (term_id)');
        $this->addSql('ALTER TABLE user CHANGE active active TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDE2C35FC');
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A106377E2C35FC');
        $this->addSql('ALTER TABLE text__synonym DROP FOREIGN KEY FK_643B33A7F30A40FF');
        $this->addSql('CREATE TABLE result_text (id INT AUTO_INCREMENT NOT NULL, text_id INT NOT NULL, language_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX user_id (user_id), INDEX text_id (text_id), INDEX IDX_ABB0BC8982F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE synonym (id INT AUTO_INCREMENT NOT NULL, word_id INT DEFAULT NULL, synonym VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX word_id (word_id, synonym), INDEX IDX_A6315EC8E357438D (word_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE word (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, word VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, audio VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, sentence INT DEFAULT NULL, is_public TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, morph VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, frequency DOUBLE PRECISION DEFAULT NULL, INDEX IDX_C3F1751161220EA6 (creator_id), INDEX word (word, creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE word_in_text (id INT AUTO_INCREMENT NOT NULL, text_id INT DEFAULT NULL, sentence_num INT NOT NULL, word VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, orig VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1B42EF50698D3548 (text_id), INDEX text_id (text_id, sentence_num, word), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE result_text ADD CONSTRAINT FK_ABB0BC89698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('ALTER TABLE result_text ADD CONSTRAINT FK_ABB0BC8982F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE result_text ADD CONSTRAINT FK_ABB0BC89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE synonym ADD CONSTRAINT FK_A6315EC8E357438D FOREIGN KEY (word_id) REFERENCES word_in_text (id)');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F1751161220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE word_in_text ADD CONSTRAINT FK_1B42EF50698D3548 FOREIGN KEY (text_id) REFERENCES text (id)');
        $this->addSql('DROP TABLE term');
        $this->addSql('DROP TABLE text__dictionary');
        $this->addSql('DROP TABLE text__passing');
        $this->addSql('DROP TABLE text__synonym');
        $this->addSql('ALTER TABLE asset ADD basic INT NOT NULL, ADD favorite INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX term_id ON cards');
        $this->addSql('ALTER TABLE cards CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE term_id word_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDE357438D FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('CREATE INDEX word_id ON cards (word_id)');
        $this->addSql('ALTER TABLE category CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE post_id post_id BIGINT UNSIGNED DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE intro CHANGE page page VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE target target VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'undefined\' COLLATE `utf8mb4_unicode_ci`, CHANGE content content TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE position position VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE sort sort INT DEFAULT 0, CHANGE active active TINYINT(1) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE language CHANGE letter letter VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE flag flag VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE log CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE message CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE readed readed INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE permission CHANGE name name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE permission_group CHANGE name name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE id id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE status status TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE comment_status comment_status INT DEFAULT 1 NOT NULL, CHANGE views views BIGINT NOT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE role CHANGE name name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE settings DROP description, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE test_result CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE text CHANGE published published INT NOT NULL');
        $this->addSql('DROP INDEX text_id ON text_extras');
        $this->addSql('ALTER TABLE text_extras ADD orig VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD extra VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP object, DROP value');
        $this->addSql('CREATE INDEX text_id ON text_extras (text_id, orig, extra)');
        $this->addSql('DROP INDEX term_id ON translate');
        $this->addSql('ALTER TABLE translate CHANGE sentence sentence INT NOT NULL, CHANGE term_id word_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A106377E357438D FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('CREATE INDEX word_id_2 ON translate (word_id)');
        $this->addSql('CREATE INDEX word_id ON translate (word_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10 ON user');
        $this->addSql('ALTER TABLE user CHANGE active active INT DEFAULT 1 NOT NULL');
    }
}
