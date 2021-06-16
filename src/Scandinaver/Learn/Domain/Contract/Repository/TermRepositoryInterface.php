<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface TermRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface TermRepositoryInterface extends BaseRepositoryInterface
{
    public function countAudio(): int;

    public function getCountByLanguage(Language $language): int;

    public function getCountAudioByLanguage(Language $language): int;

    public function getUntranslated(Language $language): array;
}