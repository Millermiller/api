<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Primitive;
use Scandinaver\Common\Domain\Services\FileService;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
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
     * @param  UploadAvatarCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        $path = $this->service->uploadAvatar($command->getUser(), $command->getPhoto());

        $this->resource = new Primitive($path);
    }
} 