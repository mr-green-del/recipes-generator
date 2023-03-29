<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if(Ingredient::query()->first() !== null) {
            return;
        }

        foreach ($this->getModelsData() as $modelData) {
            Ingredient::create($modelData);
        }
    }

    protected function getModelsData(): array
    {
        return [
            ['ingredient_type_id' => 1, 'title' => 'Тонкое тесто', 'price' => 100],
            ['ingredient_type_id' => 1, 'title' => 'Пышное тесто', 'price' => 110],
            ['ingredient_type_id' => 1, 'title' => 'Ржаное тесто', 'price' => 150],
            ['ingredient_type_id' => 2, 'title' => 'Моцарелла', 'price' => 50],
            ['ingredient_type_id' => 2, 'title' => 'Рикотта', 'price' => 70],
            ['ingredient_type_id' => 3, 'title' => 'Колбаса', 'price' => 30],
            ['ingredient_type_id' => 3, 'title' => 'Ветчина', 'price' => 35],
            ['ingredient_type_id' => 3, 'title' => 'Грибы', 'price' => 50],
            ['ingredient_type_id' => 3, 'title' => 'Томаты', 'price' => 10],
        ];
    }
}
