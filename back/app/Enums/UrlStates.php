<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UrlStates: string
{
    use EnumTrait;

    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';

    public static function states()
    {
        return [
            self::ACTIVE->value,
            self::INACTIVE->value
        ];
    }
}
