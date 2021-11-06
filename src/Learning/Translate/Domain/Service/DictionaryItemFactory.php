<?php


namespace Scandinaver\Learning\Translate\Domain\Service;


use Scandinaver\Learning\Translate\Domain\DTO\DictionaryItemDTO;
use Scandinaver\Learning\Translate\Domain\Entity\DictionaryItem;
use Scandinaver\Learning\Translate\Domain\Entity\Synonym;
use Scandinaver\Learning\Translate\Domain\Exception\SynonymAlreadyExistsException;

/**
 * Class DictionaryItemFactory
 *
 * @package Scandinaver\Translate\Domain\Service
 */
class DictionaryItemFactory
{

    /**
     * @param  DictionaryItemDTO  $dictionaryItemDTO
     *
     * @return DictionaryItem
     * @throws SynonymAlreadyExistsException
     */
    public static function fromDTO(DictionaryItemDTO $dictionaryItemDTO): DictionaryItem
    {
        $dictionaryItem = new DictionaryItem();
        $dictionaryItem->setObject($dictionaryItemDTO->getText());
        $dictionaryItem->setValue($dictionaryItemDTO->getValue());
        $dictionaryItem->setSentenceNum($dictionaryItemDTO->getSentenceNumber());
        $dictionaryItem->setCoordinates($dictionaryItemDTO->getCoordinates());

        $synonyms = $dictionaryItemDTO->getSynonyms();
        foreach ($synonyms as $synonymDTO) {
            $synonym = new Synonym($dictionaryItem, $synonymDTO->getValue());
            $dictionaryItem->addSynonym($synonym);
        }

        return $dictionaryItem;
    }
}