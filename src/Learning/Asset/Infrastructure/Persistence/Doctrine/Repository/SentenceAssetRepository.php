<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;

/**
 * Class SentenceAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class SentenceAssetRepository extends AssetRepository implements SentenceAssetRepositoryInterface
{

}