<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\FileService;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\UI\Command\UploadAvatarCommand;

/**
 * Class UploadAvatarCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UploadAvatarCommandHandler extends AbstractHandler
{

    private FileService $service;

    public function __construct(FileService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UploadAvatarCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $path = $this->service->uploadAvatar($command->getUser(), $command->getPhoto());

        $this->resource = new Item($path, fn($data) => ['path' => $data]);
    }
} 