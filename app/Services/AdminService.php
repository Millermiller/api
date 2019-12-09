<?php

namespace App\Services;

use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\Text\TextRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Word\WordRepositoryInterface;

class AdminService
{
    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;

    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;

    /**
     * @var TextRepositoryInterface
     */
    private $textRepository;

    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * UserService constructor.
     * @param AssetRepositoryInterface $assetRepository
     * @param LanguageRepositoryInterface $languageRepository
     * @param TextRepositoryInterface $textRepository
     * @param WordRepositoryInterface $wordRepository
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        LanguageRepositoryInterface $languageRepository,
        TextRepositoryInterface $textRepository,
        WordRepositoryInterface $wordRepository,
        MessageRepositoryInterface $messageRepository
    )
    {
        $this->languageRepository = $languageRepository;
        $this->assetRepository = $assetRepository;
        $this->textRepository = $textRepository;
        $this->wordRepository = $wordRepository;
        $this->messageRepository = $messageRepository;
    }

    /**
     * @return array
     */
    public function stats()
    {
        return [
                'words' => $this->wordRepository->count([]),
                'assets' => $this->assetRepository->count([]),
                'audiofiles' => $this->wordRepository->countAudio(),
                'texts' => $this->textRepository->count([]),
                'messages' => $this->messageRepository->all()
            ];
    }
}