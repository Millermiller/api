<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Query\IntroQuery;
use Scandinaver\Common\Domain\Intro;
use Scandinaver\Common\Domain\Services\IntroService;

/**
 * Class MessagesHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class IntroHandler implements IntroHandlerInterface
{
    /**
     * @var IntroService
     */
    private $introService;

    /**
     * MessagesHandler constructor.
     * @param IntroService $introService
     */
    public function __construct(IntroService $introService)
    {
        $this->introService = $introService;
    }

    /**
     * @param IntroQuery $query
     * @return Intro
     */
    public function handle($query): Intro
    {
        return $this->introService->one($query->getId());
    }
}