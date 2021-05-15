<?php


namespace Scandinaver\Common\Infrastructure\Service;

use App\Helpers\Auth;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\{LoggerInterface, LoggerTrait};
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\User\Domain\Model\User;

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
     *
     */
    public function log($level, $message, array $context = [])
    {
        $user = Auth::user();

        $log = new Log($user, $level, $message, $context);

        try {
            $this->logRepository->save($log);
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

                /** @var User $user */


                $trace = [];
                if (is_array($context)) {
                    foreach ($context as $item) {
                        if ($item instanceof \Exception) {
                            $trace[] = $item->getTraceAsString();
                        }
                    }
                }

                $log = new Log($user, $level, $message, [], $trace);
                $manager->persist($log);
                $manager->flush($log);
        }
    }
}