<?php


namespace Scandinaver\User\Application\Handler\Command;

use League\Fractal\Resource\Primitive;
use Scandinaver\Common\Domain\Services\FileService;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\UploadAvatarHandlerInterface;
use Scandinaver\User\UI\Command\UploadAvatarCommand;

/**
 * Class UploadAvatarHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UploadAvatarHandler extends AbstractHandler implements UploadAvatarHandlerInterface
{

    private FileService $service;

    public function __construct(FileService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UploadAvatarCommand|Command  $command
     */
    public function handle($command): void
    {
        $path = $this->service->uploadAvatar($command->getUser(), $command->getPhoto());

        $this->resource = new Primitive($path);
    }
} 