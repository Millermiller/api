<?php


namespace Scandinaver\Translate\Domain\Service;

use Exception;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\DTO\SynonymDTO;
use Scandinaver\Translate\Domain\Entity\Synonym;
use Scandinaver\Translate\Domain\Entity\DictionaryItem;

/**
 * Class SynonymFactory
 *
 * @package Scandinaver\Translate\Domain\Service
 */
class SynonymFactory
{

    private BaseRepositoryInterface $wordRepository;

    public function __construct(BaseRepositoryInterface $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    /**
     * @param  SynonymDTO  $synonymDTO
     *
     * @return Synonym
     * @throws Exception
     */
    public function fromDTO(SynonymDTO $synonymDTO): Synonym
    {
        /** @var DictionaryItem $word */
        $word = $this->wordRepository->find($synonymDTO->getWordId());
        if ($word === NULL) {
            throw new Exception('word ' . $synonymDTO->getWordId() . ' not found');
        }

        $synonym = new Synonym();
        $synonym->setValue($synonymDTO->getValue());
        $synonym->setWord($word);
        $word->addSynonym($synonym);

        return $synonym;
    }
}