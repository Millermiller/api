<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;

/**
 * Class ClearElasticIndex
 *
 * @package App\Console\Commands
 */
class ClearElasticIndex extends Command
{
    protected $signature = 'search:clear';

    protected $description = 'Remove search index';

    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    public function handle(): void
    {
        $this->info('Removing...');

        $this->elasticsearch->indices()->delete([
            'index' => 'terms_index',
        ]);

        $this->info('Done...');
    }
}
