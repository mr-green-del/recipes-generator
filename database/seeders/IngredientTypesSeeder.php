<?php

namespace Database\Seeders;

use App\Models\IngredientType;
use Illuminate\Database\Seeder;

class IngredientTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if(IngredientType::query()->first() !== null) {
            return;
        }

        foreach ($this->getModelsData() as $modelData) {
            IngredientType::create($modelData);
        }
    }

    protected function getModelsData(): array
    {
        return [
            ['id' => 1, 'title' => 'Тесто', 'code' => 'd'],
            ['id' => 2, 'title' => 'Сыр', 'code' => 'c'],
            ['id' => 3, 'title' => 'Начинка', 'code' => 'i'],
        ];
    }
}
