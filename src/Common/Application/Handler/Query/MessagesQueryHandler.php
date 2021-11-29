<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\FeedbackService;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Scandinaver\Common\UI\Resource\FeedbackTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class MessagesQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessagesQueryHandler extends AbstractHandler
{

    public function __construct(private FeedbackService $service)
    {
        parent::__construct();
    }

    /**
     * @param  MessagesQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $feedbacks = $this->service->all();

        $this->resource = new Collection($feedbacks, new FeedbackTransformer());
    }
} 