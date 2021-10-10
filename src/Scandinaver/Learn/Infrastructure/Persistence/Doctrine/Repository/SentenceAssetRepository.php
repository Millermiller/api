<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Asset;

/**
 * Class SentenceAssetRepository
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository
 */
class SentenceAssetRepository extends AssetRepository implements SentenceAssetRepositoryInterface
{

}