<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;
use Scandinaver\Learn\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Word;

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

    private TermRepositoryInterface $wordRepository;

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

        $this->wordRepository = $wordRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Indexing all articles. This might take a while...');

        /** @var Word[] $words */
        $words = $this->wordRepository->findAll();

        foreach ($words as $word) {
            $this->elasticsearch->index([
                'index' => $word->searchableAs(),
                'id'    => $word->getId(),
                'body'  => $word->toSearchableArray(),
            ]);

            $this->output->write('.');
        }
        $this->info('\nDone!');
    }
}
