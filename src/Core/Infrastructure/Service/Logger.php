<?php


namespace Scandinaver\Core\Infrastructure\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Support\Env;
use Psr\Log\{LoggerInterface, LoggerTrait};
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Log;
use Throwable;

/**
 * Class Logger
 *
 * @package Scandinaver\Common\Infrastructure\Service
 */
class Logger implements LoggerInterface
{
    use LoggerTrait;

    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * @param  mixed   $level
     * @param  string  $message
     * @param  array   $context
     * TODO: refactor. Use Monolog
     * @throws ORMException
     */
    public function log($level, $message, array $context = [])
    {
        $manager = app('em');

        $manager = $manager->create(
            $manager->getConnection(),
            $manager->getConfiguration()
        );

        if (array_key_exists('exception', $context)) {
            /** @var Throwable $exception */
            $exception = $context['exception'];
            $trace[] = $exception->getTraceAsString();
        } else {
            $trace = $context;
        }

        $log = new Log(NULL, $level, $message, $trace, $trace);

        try {
            $manager->persist($log);
            $manager->flush($log);
        } catch (Exception $e) {

                \Illuminate\Support\Facades\Log::error($message, $context);

                /** @var EntityManagerInterface $manager */
                $manager = app('em');

                if (!$manager->isOpen()) {
                    $manager = $manager->create(
                        $manager->getConnection(),
                        $manager->getConfiguration()
                    );
                }

                $trace = [];
                if (is_array($context)) {
                    foreach ($context as $item) {
                        if (is_object($item) && method_exists($item, 'getTraceAsString')) {
                            $trace[] = $item->getTraceAsString();
                        }
                    }
                }

                $log = new Log(NULL, $level, $message, [], $trace);
                // TODO: wtf
                if (Env::get('APP_ENV') !== 'testing') {
                    $manager->persist($log);
                    $manager->flush($log);
                }
        }
    }
}