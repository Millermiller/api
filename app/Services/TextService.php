<?php

namespace App\Services;

use App\Entities\Language;
use App\Entities\User;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Text\TextRepository;
use App\Repositories\Text\TextRepositoryInterface;

class TextService
{
    /**
     * @var TextRepository
     */
    private $textRepository;

    /**
     * @var LanguageRepository
     */
    private $languageRepository;

    public function __construct(TextRepositoryInterface $textRepository, LanguageRepositoryInterface $languageRepository)
    {
        $this->textRepository = $textRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @param User $user
     * @return mixed
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function getTextsForUser(User $user)
    {
        /** @var Language $language */
        $language = $this->languageRepository->get(config('app.lang'));

        $activeArray  = $this->textRepository->getActiveIds($user,  $language);

        $texts = $this->textRepository->getByLanguage($language);

        $counter = 0;

        foreach($texts as &$text) {

            $counter++;

            if (in_array($text->getId(), $activeArray))
                $text = ['id' => $text->getId(),  'title'=> $text->getTitle(),'active' => true, 'image'=> $text->getImage(), 'description' => $text->getDescription()];
            else
                $text = ['id' => $text->getId(),  'title'=> $text->getTitle(),'active' => false, 'image'=> $text->getImage(), 'description' => $text->getDescription()];


            if($counter < 3 || $user->getActive())
                $text['available'] = true;
            else
                $text['available'] = false;
        }

        return $texts;
    }
}