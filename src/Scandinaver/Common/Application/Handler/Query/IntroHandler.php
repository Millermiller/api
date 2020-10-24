<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\IntroHandlerInterface;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\Domain\Model\IntroDTO;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Query\IntroQuery;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntroHandler implements IntroHandlerInterface
{
    private IntroService $introService;

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
     * @return IntroDTO
     */
    public function handle($query): IntroDTO
    {
        return $this->introService->one($query->getId());
    }
}