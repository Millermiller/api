<?php


namespace Scandinaver\Learning\Asset\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface TermRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Term>
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface TermRepositoryInterface extends BaseRepositoryInterface
{
    public function countAudio(): int;

    public function getCountByLanguage(Language $language): int;

    public function getCountAudioByLanguage(Language $language): int;

    public function getUntranslated(Language $language): array;
}