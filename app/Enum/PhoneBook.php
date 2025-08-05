<?php

namespace App\Enum;

enum PhoneBook: string
{
    case cameroonCode = '237';
    case ethiopiaCode = '251';
    case moroccoCode = '212';
    case mozambiqueCode = '258';
    case ugandaCode = '256';

    public static function countryCodesAsKeyValue(): array
    {
        return [
            self::cameroonCode->value => 'Cameroon',
            self::ethiopiaCode->value => 'Ethiopia',
            self::moroccoCode->value => 'Morocco',
            self::mozambiqueCode->value => 'Mozambique',
            self::ugandaCode->value => 'Uganda',
        ];
    }

    public static function countryCodesPatterns(): array
    {
        return [
            self::cameroonCode->value => '/\(237\)\ ?[2368]\d{7,8}$/',
            self::ethiopiaCode->value => '/\(251\)\ ?[1-59]\d{8}$/',
            self::moroccoCode->value => '/\(212\)\ ?[5-9]\d{8}$/',
            self::mozambiqueCode->value => '/\(258\)\ ?[28]\d{7,8}$/',
            self::ugandaCode->value => '/\(256\)\ ?\d{9}$/',
        ];
    }
}
