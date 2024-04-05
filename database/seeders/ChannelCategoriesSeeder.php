<?php

namespace Database\Seeders;

use App\Models\ChannelCategory;
use Illuminate\Database\Seeder;

class ChannelCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChannelCategory::insert([
            [
                'id' => 1,
                'name' => 'ДЕТСКИЕ',
            ],
            [
                'id' => 2,
                'name' => 'ДОМАШНИЕ ЖИВОТНЫЕ',
            ],
            [
                'id' => 3,
                'name' => 'ИНФОРМАЦИОННО-РАЗВЛЕКАТЕЛЬНЫЕ',
            ],
            [
                'id' => 4,
                'name' => 'МУЗЫКАЛЬНЫЕ',
            ],
            [
                'id' => 5,
                'name' => 'НАЦИОНАЛЬНЫЕ',
            ],
            [
                'id' => 6,
                'name' => 'НОВОСТНЫЕ',
            ],
            [
                'id' => 7,
                'name' => 'ОНЛАЙН-КИНОТЕАТР',
            ],
            [
                'id' => 8,
                'name' => 'ПОЗНАВАТЕЛЬНЫЕ',
            ],
            [
                'id' => 9,
                'name' => 'РАЗВЛЕКАТЕЛЬНЫЕ',
            ],
            [
                'id' => 10,
                'name' => 'РЕГИОНАЛЬНЫЕ',
            ],
            [
                'id' => 11,
                'name' => 'РЕЛИГИОЗНЫЕ',
            ],
            [
                'id' => 12,
                'name' => 'СЕРИАЛЬНЫЕ',
            ],
            [
                'id' => 13,
                'name' => 'СПОРТИВНЫЕ',
            ],
            [
                'id' => 14,
                'name' => 'ТЕМАТИЧЕСКИЕ',
            ],
            [
                'id' => 15,
                'name' => 'ТЕМАТИЧЕСКИЕ ЖЕНСКИЕ',
            ],
            [
                'id' => 16,
                'name' => 'ТЕМАТИЧЕСКИЕ МУЖСКИЕ',
            ],
            [
                'id' => 17,
                'name' => 'ФИЛЬМОВЫЕ',
            ],
        ]);
    }
}
