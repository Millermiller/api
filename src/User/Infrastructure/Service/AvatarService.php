<?php


namespace Scandinaver\User\Infrastructure\Service;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Image;
use Intervention\Image\Constraint;
use Laravolt\Avatar\Avatar;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;

/**
 * Class AvatarService
 *
 * @package Scandinaver\User\Infrastructure\Service
 */
class AvatarService implements AvatarServiceInterface
{

    private Avatar $service;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->service = app()->make('avatar');
    }

    /**
     * @param  UserInterface  $user
     *
     * @return string
     */
    public function getAvatar(UserInterface $user): string
    {
        $photo = $user->getPhoto();
        $login = $user->getLogin();

        $isAvatarExists = file_exists(public_path('/uploads/u/a/') . $photo);
        $isOrigExists   = file_exists(public_path('/uploads/u/') . $photo);

        if ($photo !== NULL) {
            if ($isAvatarExists) {
                return asset('/uploads/u/a/' . $photo);
            }
            else {
                if ($isOrigExists) {
                    try {
                        $avatar = Image::make(public_path('/uploads/u/') . $photo);
                        $avatar->resize(
                            300,
                            NULL,
                            function ($constraint) {
                                /** @var Constraint $constraint */
                                $constraint->aspectRatio();
                            }
                        );
                        $avatar->save(public_path('/uploads/u/a/' . $photo));

                        return asset('/uploads/u/a/' . $photo);
                    } catch (Exception $exception) {
                        return $this->service->create($login)->toBase64();
                    }
                }
                else {
                    return $this->service->create($login)->toBase64();
                }
            }
        }
        else {
            return $this->service->create($login)->toBase64();
        }
    }
}