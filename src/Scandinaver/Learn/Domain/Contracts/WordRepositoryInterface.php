<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface WordRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface WordRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return int
     */
    public function countAudio(): int;

    /**
     * @param Language $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int;

    /**
     * @param Language $language
     *
     * @return int
     */
    public function getCountAudioByLanguage(Language $language): int;
}