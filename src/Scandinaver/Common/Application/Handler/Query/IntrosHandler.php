<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\IntrosHandlerInterface;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Query\IntrosQuery;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntrosHandler implements IntrosHandlerInterface
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
     * @param  IntrosQuery  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->introService->all();
    }
}