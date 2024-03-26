<?php

namespace App\Enums;

enum Exchanges: string
{
    case Start = 'Курс на начало периода';
    case Stop = 'Курс на конец периода';
}
