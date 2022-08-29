<?php

namespace App\Enums;

enum HddTypesEnum: int
{
    case SAS = 0;
    case SATA = 1;
    case SSD = 2;
    /**
     * @return array[]
     */
    public static function getOptions(): array
    {
        return [
            [
                'value' => self::SAS->value,
                'text' => __('SAS'),
            ],
            [
                'value' => self::SATA->value,
                'text' => __('SATA'),
            ],
            [
                'value' => self::SSD->value,
                'text' => __('SSD'),
            ],
        ];
    }
}