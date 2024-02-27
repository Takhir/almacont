<?php

namespace App\Enums;

enum Currencies: string
{
    case Tenge = 'ТЕНГЕ';
    case Dollar = 'ДОЛЛАР';
    case Euro = 'ЕВРО';
    case Ruble = 'РУБЛЬ';
    case PoundSterling = 'ФУНТ СТЕРЛИНГ';
}
