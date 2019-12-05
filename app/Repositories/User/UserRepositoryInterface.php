<?php


namespace App\Repositories\User;

use App\Entities\Asset;
use App\Entities\Plan;
use App\Entities\Text;
use App\Entities\User;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function addAsset(User $user, Asset $asset) : void;

    public function addText(User $user, Text $text) : void;

    public function setPlan(User $user, Plan $plan) : void ;
}