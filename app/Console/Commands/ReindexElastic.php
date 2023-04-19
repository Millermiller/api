<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use EntityManager;
use Illuminate\Console\Command;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class ReindexElastic
 *
 * @package App\Console\Commands
 */
class ReindexElastic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all words to Elasticsearch';

    private Client $elasticsearch;

    private TermRepositoryInterface $termRepository;

    /**
     * Create a new command instance.
     *
     * @param  Client                   $elasticsearch
     * @param  TermRepositoryInterface  $wordRepository
     */
    public function __construct(Client $elasticsearch, TermRepositoryInterface $wordRepository)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;

        $this->termRepository = $wordRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Indexing all terms. This might take a while...');

        $totalRecords = $this->termRepository->count([]);

        $this->info('Terms find: ' . $totalRecords);

        $totalProcessed = 0;
        $processing = TRUE;
        $numberOfRecordsPerPage = 1000;

        $bar = $this->output->createProgressBar($totalRecords);
        $bar->setRedrawFrequency(1);
        ProgressBar::setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %percent:3s%% | %memory:6s% | %term% ');
        $bar->setFormat('custom');

        while ($processing) {
            $query = EntityManager::createQuery('SELECT t FROM Scandinaver\Learning\Asset\Domain\Entity\Term t')
                                   ->setMaxResults($numberOfRecordsPerPage)
                                   ->setFirstResult($totalProcessed);

            $iterableResult = $query->toIterable();

            /** @var Term $term */
            foreach ($iterableResult as $term) {
                $totalProcessed++;

                $this->elasticsearch->index([
                    'index' => $term->searchableAs(),
                    'id'    => $term->getId(),
                    'body'  => $term->toSearchableArray(),
                ]);

                $bar->setMessage($term->getValue(), 'term');
                $bar->advance();

                // $this->output->write('.');

                if ($totalProcessed === $totalRecords) {
                    break;
                }
            }
        }

        $this->info('\nDone!');
    }
}
