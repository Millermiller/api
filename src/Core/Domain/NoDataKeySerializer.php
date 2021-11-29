<?php


namespace Scandinaver\Core\Domain;

use League\Fractal\Serializer\ArraySerializer;

/**
 * Class NoDataKeySerializer
 *
 * @package Scandinaver\Shared
 */
class NoDataKeySerializer extends ArraySerializer
{
    /**
     * @param  string  $resourceKey
     * @param  array   $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }
}