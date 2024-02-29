<?php

namespace App\Repositories;

use App\Models\CurrencyType;

class CurrencyTypeRepository
{

    public function getAll()
    {
        return CurrencyType::all();
    }

    public function getNameById($id)
    {
        return CurrencyType::getNameById($id);
    }
}
