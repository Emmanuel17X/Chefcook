<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = Ingredient::count() < 5
            ? collect([
                Ingredient::create([
                    'nom' => 'oeuf',
                    'picture' => 'oeuf.JPEG'
                ]),
                Ingredient::create([
                    'nom' => 'Poivre',
                    'picture' => 'poivre.JPEG'
                ]),
                Ingredient::create([
                    'nom' => 'Farine de blé',
                    'picture' => 'floor.JPEG'
                ]),
                Ingredient::create([
                    'nom' => 'Sel',
                    'picture' => 'sel.JPEG'
                ]),
                Ingredient::create([
                    'nom' => 'Beurre',
                    'picture' => 'beurre.JPEG'
                ])
            ]):Ingredient::take(5)->get();
    }
}
