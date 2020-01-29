<?php

namespace Scandinaver\Common\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use PDO;

/**
 * Class ColumnHydrator
 * @package App\Hydrators
 */
class ColumnHydrator extends AbstractHydrator
{
    /**
     * @inheritDoc
     */
    protected function hydrateAllData()
    {
        return $this->_stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}