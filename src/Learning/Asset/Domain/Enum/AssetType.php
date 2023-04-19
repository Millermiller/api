<?php

namespace Scandinaver\Learning\Asset\Domain\Enum;

/**
 *
 */
enum AssetType: int
{
    case WORDS = 1;
    case SENTENCES = 2;
    case PERSONAL = 3;
    case FAVORITES = 4;
}