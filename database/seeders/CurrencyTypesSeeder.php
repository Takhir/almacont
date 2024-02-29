<?php

namespace Database\Seeders;

use App\Models\CurrencyType;
use Illuminate\Database\Seeder;

class CurrencyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurrencyType::insert([
            [
                'id' => 1,
                'name' => 'ТЕНГЕ',
            ],
            [
                'id' => 2,
                'name' => 'ДОЛЛАР',
            ],
            [
                'id' => 3,
                'name' => 'РУБЛЬ',
            ],
            [
                'id' => 4,
                'name' => 'ЕВРО',
            ],
            [
                'id' => 5,
                'name' => 'ФУНТ СТЕРЛИНГ',
            ]
        ]);
    }
}
