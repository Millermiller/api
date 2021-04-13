<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200627151711 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'THIS MIGRATIONS CAN ONLY BE EXECUTED ON SQLITE!');

        $this->addSql(
            'CREATE TABLE category (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    title VARCHAR(255), 
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE post (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    user_id VARCHAR(255), 
                    category_id VARCHAR(255),
                    language_id VARCHAR(255),
                    title VARCHAR(255),
                    content VARCHAR(255),
                    anonse VARCHAR(255),
                    status VARCHAR(255),
                    comment_status VARCHAR(255),
                    views VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE comment (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    post_id VARCHAR(255),
                    user_id VARCHAR(255), 
                    text VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE user(
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    name VARCHAR(255),
                    login VARCHAR(255),
                    email VARCHAR(255),
                    plan_id VARCHAR(255),
                    photo VARCHAR(255),
                    password VARCHAR(255),
                    active VARCHAR(255),
                    assets_opened VARCHAR(255),
                    assets_created VARCHAR(255),
                    role VARCHAR(255),
                    remember_token VARCHAR(255),
                    updated_at VARCHAR(255),
                    active_to VARCHAR(255),
                    restore_link VARCHAR(255),
                    created_at VARCHAR(255),
                    deleted_at VARCHAR(255),
                    last_online VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE asset(
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    title VARCHAR(255), 
                    basic VARCHAR(255),
                    type VARCHAR(255), 
                    category VARCHAR(255),
                    level VARCHAR(255),
                    favorite VARCHAR(255),
                    language_id VARCHAR(255),
                    owner_id VARCHAR(255),
                    updated_at VARCHAR(255),
                    created_at VARCHAR(255),
                    deleted_at VARCHAR(255))');

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
            'CREATE TABLE word (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    word VARCHAR(255),
                    creator_id VARCHAR(255),
                    audio VARCHAR(255),
                    sentence VARCHAR(255),
                    is_public VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255),
                    morph VARCHAR(255),
                    frequency VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE translate (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    word_id VARCHAR(255), 
                    value VARCHAR(255), 
                    sentence VARCHAR(255), 
                    updated_at VARCHAR(255), 
                    created_at VARCHAR(255), 
                    language_id VARCHAR(255)
                    )');

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
            'CREATE TABLE cards (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    language_id VARCHAR(255), 
                    translate_id VARCHAR(255), 
                    word_id VARCHAR(255), 
                    user_id VARCHAR(255), 
                    type VARCHAR(255), 
                    updated_at VARCHAR(255), 
                    created_at VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE asset_cards (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    asset_id VARCHAR(255), 
                    card_id VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE plan (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    name VARCHAR(255), 
                    period VARCHAR(255), 
                    cost VARCHAR(255), 
                     cost_per_month VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE log (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    message VARCHAR(255), 
                    level VARCHAR(255), 
                    level_name VARCHAR(255), 
                    context VARCHAR(255),
                    extra VARCHAR(255),
                    created_at VARCHAR(255),
                    occured_on VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE message (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    message VARCHAR(255), 
                    name VARCHAR(255), 
                    readed VARCHAR(1), 
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE intro (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    page VARCHAR(255), 
                    target VARCHAR(255),
                    content VARCHAR(255),
                    position VARCHAR(255),
                    tooltipClass VARCHAR(255),
                    sort VARCHAR(255),
                    active VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE role (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    name VARCHAR(255), 
                    slug VARCHAR(255),
                    description VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE permission (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    name VARCHAR(255), 
                    slug VARCHAR(255),
                    permission_group_id VARCHAR(255),
                    description VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE role_permission (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    role_id VARCHAR(255), 
                    permission_id VARCHAR(255))');

        $this->addSql(
          'CREATE TABLE permission_group (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                     name VARCHAR(255), 
                    slug VARCHAR(255),
                    description VARCHAR(255),
                    created_at VARCHAR(255),
                    updated_at VARCHAR(255)
                    )');

        $this->addSql(
            'CREATE TABLE user_permission (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    user_id VARCHAR(255), 
                    permission_id VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE user_role (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    user_id VARCHAR(255), 
                    role_id VARCHAR(255))');

        $this->addSql(
          'CREATE TABLE result_asset (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    user_id VARCHAR(255), 
                    created_at VARCHAR(255), 
                    updated_at VARCHAR(255), 
                    result VARCHAR(255), 
                    asset_id VARCHAR(255))');

        $this->addSql(
            'CREATE TABLE test_result (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
                    completed VARCHAR(255), 
                    percent VARCHAR(255), 
                    data VARCHAR(255), 
                    created_at VARCHAR(255), 
                    updated_at VARCHAR(255),
                    asset_id VARCHAR(255),
                    language_id VARCHAR(255),
                    user_id VARCHAR(255)
                    )');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {

    }
}
