<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\IntroHandlerInterface;
use Scandinaver\Common\Domain\Intro;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Query\IntroQuery;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntroHandler implements IntroHandlerInterface
{
    /**
     * @var IntroService
     */
    private $introService;

    /**
     * MessagesHandler constructor.
     *
     * @param  IntroService  $introService
     */
    public function __construct(IntroService $introService)
    {
        $this->introService = $introService;
    }

    /**
     * @param  IntroQuery  $query
     *
     * @return Intro
     */
    public function handle($query): Intro
    {
        return $this->introService->one($query->getId());
    }
}