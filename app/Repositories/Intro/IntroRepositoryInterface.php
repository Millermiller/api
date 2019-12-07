<?php

namespace App\Repositories\Intro;

use App\Repositories\BaseRepositoryInterface;

interface IntroRepositoryInterface extends BaseRepositoryInterface
{
    public function getGrouppedIntro();
}