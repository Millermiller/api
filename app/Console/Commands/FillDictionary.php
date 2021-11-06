<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Learning\Asset\UI\Command\FillDictionaryCommand;
use Scandinaver\Shared\CommandBus;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class FillDictionary
 *
 * @package App\Console\Commands
 */
class FillDictionary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scandinaver:fill {Language}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make translates and cards for language';

    private CommandBus $commandBus;

    private TermRepositoryInterface $wordRepository;
    /**
     * @var LanguageRepositoryInterface
     */
    private LanguageRepositoryInterface $languageRepository;

    /**
     * FillDictionary constructor.
     *
     * @param  CommandBus                   $commandBus
     * @param  TermRepositoryInterface      $wordRepository
     * @param  LanguageRepositoryInterface  $languageRepository
     */
    public function __construct(CommandBus $commandBus, TermRepositoryInterface $wordRepository, LanguageRepositoryInterface $languageRepository)
    {
        parent::__construct();
        $this->commandBus         = $commandBus;
        $this->wordRepository     = $wordRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $letter = $this->argument('Language');
        $language = $this->languageRepository->findOneBy([
            'letter' => $letter
        ]);

        if ($language === NULL) {
            $this->error('Language: ' . $letter . ' not found');
            exit;
        }

        $this->info('Language: ' . $language->getTitle());

        $this->comment('Get words..');

        /** @var Term[] $terms */
        $terms = $this->wordRepository->getUntranslated($language);

        $this->info('Words to translate: ' . count($terms));

        $bar = $this->output->createProgressBar(count($terms));
        $bar->setRedrawFrequency(1);
        ProgressBar::setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %percent:3s%% | %memory:6s% | %word% ');
        $bar->setFormat('custom');
        foreach ($terms as $term) {
            $bar->setMessage($term->getValue(), 'word');
            $this->commandBus->execute(new FillDictionaryCommand($language->getLetter(), $term->getId()));
            $bar->advance();
        }

        $bar->finish();
    }
}
