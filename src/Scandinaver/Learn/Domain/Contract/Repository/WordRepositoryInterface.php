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
    public function countAudio(): int;

    public function getCountByLanguage(Language $language): int;

    public function getCountAudioByLanguage(Language $language): int;

    public function getUntranslated(Language $language): array;
}