<?php


namespace Scandinaver\Core\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use LaravelDoctrine\ORM\Types\Json;

/**
 * Class UnicodeJsonType
 *
 * @package Scandinaver\Core\Infrastructure\Service
 */
class UnicodeJsonType extends Json
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (NULL === $value) {
            return NULL;
        }

        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}