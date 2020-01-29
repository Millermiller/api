<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Contracts\WordRepositoryInterface;

/**
 * Class AudioService
 * @package Scandinaver\Learn\Domain\Services
 */
class AudioService
{
    /**
     * @var WordRepositoryInterface
     */
    private $wordsRepository;

    /**
     * WordService constructor.
     * @param WordRepositoryInterface $wordsRepository
     */
    public function __construct( WordRepositoryInterface $wordsRepository)
    {
        $this->wordsRepository = $wordsRepository;
    }

    /**
     * @param Language $language
     * @return int
     */
    public function count(Language $language): int
    {
        return $this->wordsRepository->getCountAudioByLanguage($language);
    }
}