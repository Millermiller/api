<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\FeedbackService;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Scandinaver\Common\UI\Resource\FeedbackTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class MessagesQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessagesQueryHandler extends AbstractHandler
{

    private FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        parent::__construct();

        $this->feedbackService = $feedbackService;
    }

    /**
     * @param  MessagesQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $feedbacks = $this->feedbackService->all();

        $this->resource = new Collection($feedbacks, new FeedbackTransformer());
    }
} 