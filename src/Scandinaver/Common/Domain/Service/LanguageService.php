<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\DTO\LanguageDTO;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;

/**
 * Class LanguageService
 *
 * @package Scandinaver\Common\Domain\Service
 */
class LanguageService implements BaseServiceInterface
{
    use LanguageTrait;

    private LanguageRepositoryInterface $languageRepository;

    private FileService $fileService;

    public function __construct(
        LanguageRepositoryInterface $languageRepository,
        FileService $fileService
    ) {
        $this->languageRepository = $languageRepository;
        $this->fileService = $fileService;
    }

    public function all(): array
    {
        return $this->languageRepository->findAll();
    }

    public function one(int $id): DTO
    {
        // TODO: Implement one() method.
    }

    public function createLanguage(array $data): Language
    {
        $languageDTO = new LanguageDTO();
        $languageDTO->setTitle($data['title']);
        $languageDTO->setLetter($data['letter']);

        $language = LanguageFactory::fromDTO($languageDTO);

        if (isset($data['flag'])) {
            $flagPath = $this->fileService->uploadFlag($language, $data['flag']);
            $language->setFlag($flagPath);
        }

        $this->languageRepository->save($language);

        //TODO: implements creating favourite assets and other events

        return $language;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return Language
     * @throws LanguageNotFoundException
     */
    public function updateLanguage(int $id, array $data): Language
    {
        $language = $this->getLanguageByid($id);

        if ($data['flag'] !== NULL) {
            $flagPath = $this->fileService->uploadFlag($language, $data['flag']);
            $language->setFlag($flagPath);
        }

        unset($data['flag']);

        $this->languageRepository->update($language, $data);

        return $language;
    }

    /**
     * @param  int  $id
     *
     * @throws LanguageNotFoundException
     */
    public function deleteLanguage(int $id): void
    {
        $language = $this->getLanguageByid($id);

        $language->delete();

        $this->languageRepository->delete($language);
    }
}