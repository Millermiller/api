<?php

namespace App\Repositories\Text;

use App\Entities\Text;
use App\Entities\Language;
use App\Repositories\BaseRepositoryInterface;

/**
 * Interface TextRepositoryInterface
 * @package App\Repositories\Text
 */
interface TextRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Language $language
     * @return Text
     */
    public function getFirstText(Language $language) : Text;
}