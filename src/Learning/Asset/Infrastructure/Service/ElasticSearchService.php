<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Service;

use Elasticsearch\Client;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Term;

/**
 * Class ElasticSearchService
 *
 * @package Scandinaver\Learn\Infrastructure\Service
 */
class ElasticSearchService implements SearchInterface
{
    private Client $elasticsearch;

    private CardRepositoryInterface $cardRepository;

    public function __construct(Client $elasticsearch, CardRepositoryInterface $cardRepository)
    {
        $this->elasticsearch = $elasticsearch;
        $this->cardRepository = $cardRepository;
    }

    public function search(Language $language, ?string $query, bool $isSentence): array
    {
        if ($query === NULL) {
            return $this->cardRepository->findBy([
                'type' => (int)$isSentence
            ]);
        }

        $cards  = [];
        $model  = new Term();
        $result = $this->elasticsearch->search([
            'index' => $model->searchableAs(),
            'body'  => [
                "query" => [
                    "bool" => [
                        "must" => [
                            ["match" => ["value" => $query]],
                            ["match" => ["is_sentence" => (int)$isSentence]],
                        ],
                    ],
                ],
            ],
        ]);

        // TODO: check is public
        foreach($result['hits']['hits'] as $item) {
            $id = (int) $item['_id'];
            $cards += $this->cardRepository->findBy([
                'value' => $id
            ]);
        }

        return $cards;
    }
}