<?php


namespace Scandinaver\Statistic\Domain\Entity;

/**
 * Class Achievement
 *
 * @package Scandinaver\Statistic\Domain\Entity
 */
class Achievement
{
    private string $id;
    private string $title;
    private string $description;
    private string $image;
    private string $fullImage;
    private string $measure;
    private string $condition;
    private bool $active;
}