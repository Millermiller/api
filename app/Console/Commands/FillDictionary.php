<?php

namespace App\Console\Commands;

use Doctrine\ORM\NoResultException;
use Illuminate\Console\Command;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Word;
use Scandinaver\Learn\UI\Command\FillDictionaryCommand;
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

    public function handle()
    {
        $letter = $this->argument('Language');

        try {
            $language = $this->languageRepository->getByName($letter);
        } catch (NoResultException $exception) {
            $this->error('Language: ' . $letter . ' not found');
            exit;
        }

        $this->info('Language: ' . $language->getLabel());

        $this->comment('Get words..');

        /** @var Word[] $words */
        $words = $this->wordRepository->getUntranslated($language);

        $this->info('Words to translate: ' . count($words));

        $bar = $this->output->createProgressBar(count($words));
        $bar->setRedrawFrequency(1);
        ProgressBar::setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %percent:3s%% | %memory:6s% | %word% ');
        $bar->setFormat('custom');
        foreach ($words as $word) {
            $bar->setMessage($word->getWord(), 'word');
            $this->commandBus->execute(new FillDictionaryCommand($language, $word));
            $bar->advance();
        }

        $bar->finish();
    }
}
