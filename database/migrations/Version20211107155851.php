<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20211107155851 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE jobs (
        id INT AUTO_INCREMENT NOT NULL, 
        queue VARCHAR(255) NOT NULL, 
        payload LONGTEXT NOT NULL, 
        attempts INT(11),
        reserved_at INT(11),
        available_at INT(11),
        created_at INT(11),
        INDEX queue (queue), 
        PRIMARY KEY(id)) 
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {

    }
}
