<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200627151711 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'THIS MIGRATIONS CAN ONLY BE EXECUTED ON SQLITE!');

        $this->addSql(
            'CREATE TABLE user(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name VARCHAR(255),login VARCHAR(255),email VARCHAR(255),plan_id VARCHAR(255),photo VARCHAR(255),password VARCHAR(255),active VARCHAR(255),assets_opened VARCHAR(255),assets_created VARCHAR(255),role VARCHAR(255),remember_token VARCHAR(255),updated_at VARCHAR(255),active_to VARCHAR(255),restore_link VARCHAR(255),created_at VARCHAR(255),deleted_at VARCHAR(255),last_online VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE asset(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,title VARCHAR(255), basic VARCHAR(255), type VARCHAR(255), level VARCHAR(255),favorite VARCHAR(255),language_id VARCHAR(255),updated_at VARCHAR(255),created_at VARCHAR(255),deleted_at VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE asset_user (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    asset_id VARCHAR(255), 
                    user_id VARCHAR(255), 
                    result VARCHAR(255), 
                    updated_at VARCHAR(255),
                    created_at VARCHAR(255),
                    language_id VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE word (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,word VARCHAR(255),transcription VARCHAR(255),audio VARCHAR(255),sentence VARCHAR(255),is_public VARCHAR(255),creator_id VARCHAR(255),language_id VARCHAR(255),updated_at VARCHAR(255),created_at VARCHAR(255),deleted_at VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE translate (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    value VARCHAR(255), 
                    sentence VARCHAR(255), 
                    variant VARCHAR(255), 
                    form VARCHAR(255), 
                    word_id VARCHAR(255), 
                    updated_at VARCHAR(255), 
                    created_at VARCHAR(255), 
                    deleted_at VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE language (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    name VARCHAR(255), 
                    label VARCHAR(255), 
                    flag VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE card (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    asset_id VARCHAR(255), 
                    translate_id VARCHAR(255), 
                    word_id VARCHAR(255), 
                    updated_at VARCHAR(255), 
                    created_at VARCHAR(255), 
                     deleted_at VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE plan (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    name VARCHAR(255), 
                    period VARCHAR(255), 
                    cost VARCHAR(255), 
                     cost_per_month VARCHAR(255))');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
