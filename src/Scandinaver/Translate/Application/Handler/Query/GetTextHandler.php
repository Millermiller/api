<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Doctrine\DBAL\DBALException;
use Scandinaver\Translate\Domain\Contract\Query\GetTextHandlerInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\Translate\Domain\TextService;
use Scandinaver\Translate\UI\Query\GetTextQuery;

/**
 * Class GetTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class GetTextHandler implements GetTextHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param  GetTextQuery  $query
     *
     * @return Text
     * @throws DBALException
     * @throws TextNotFoundException
     */
    public function handle($query)
    {
        return $this->textService->prepareText($query->getText());
    }
} 