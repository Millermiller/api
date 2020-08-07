<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface WordRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface WordRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return int
     */
    public function countAudio(): int;

    /**
     * @param  Language  $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int;

    /**
     * @param  Language  $language
     *
     * @return int
     */
    public function getCountAudioByLanguage(Language $language): int;
}