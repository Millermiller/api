<?php

namespace Scandinaver\Statistic\Domain\Enum;

/**
 *
 */
enum StatisticType: string
{

    case USER_VISITED = 'USER_VISITED';
    case ASSET_CREATED = 'ASSET_CREATED';
    case ASSET_DELETED = 'ASSET_DELETED';
    case ASSET_OPEN = 'ASSET_OPEN';
    case ASSET_PASSED = 'ASSET_PASSED';
    case CARD_ADDED = 'CARD_ADDED';
    case CARD_REMOVED = 'CARD_REMOVED';
    case CARD_CREATED = 'CARD_CREATED';
    case TRANSLATE_PASSED = 'TRANSLATE_PASSED';
    case PUZZLE_PASSED = 'PUZZLE_PASSED';
}