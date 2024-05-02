<?php

namespace App\Repositories;

use App\Models\CurrencyType;

class CurrencyTypeRepository
{

    public function getAll()
    {
        return CurrencyType::all();
    }

    public function getNameById(int $id)
    {
        return CurrencyType::getNameById($id);
    }

    public function getIdByName(string $name)
    {
        return CurrencyType::getIdByName($name);
    }
}
