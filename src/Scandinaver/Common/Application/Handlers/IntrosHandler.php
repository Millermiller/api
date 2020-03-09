<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Query\IntrosQuery;
use Scandinaver\Common\Domain\Services\IntroService;

/**
 * Class MessagesHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class IntrosHandler implements IntrosHandlerInterface
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
     * @param IntrosQuery $query
     * @return array
     */
    public function handle($query): array
    {
        return $this->introService->all();
    }
}