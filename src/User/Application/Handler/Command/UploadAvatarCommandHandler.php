<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\FileService;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\UI\Command\UploadAvatarCommand;

/**
 * Class UploadAvatarCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UploadAvatarCommandHandler extends AbstractHandler
{

    public function __construct(private FileService $service)
    {
        parent::__construct();
    }

    public function handle(CommandInterface|UploadAvatarCommand $command): void
    {
        $path = $this->service->uploadAvatar($command->getUser(), $command->getPhoto());

        $this->resource = new Item($path, fn($data) => ['path' => $data]);
    }
} 