<?php


namespace Scandinaver\Learn\Infrastructure\Service;


use Elasticsearch\Client;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learn\Domain\Model\Word;

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

    public function search(Language $language, string $query, bool $isSentence): array
    {
        $cards  = [];
        $model  = new Word();
        $result = $this->elasticsearch->search([
            'index' => $model->searchableAs(),
            'body'  => [
                "query" => [
                    "bool" => [
                        "must" => [
                            ["match" => ["word" => $query]],
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
                'word' => $id
            ]);
        }

        return $cards;
    }
}