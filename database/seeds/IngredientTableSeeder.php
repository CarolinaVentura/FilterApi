<?php

use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Ingredient::create([
            'name'=>'cacau',

        ]);

        \App\Ingredient::create([
            'name'=>'soro de leite',

        ]);

        \App\Ingredient::create([
            'name'=>'avelã',

        ]);
    }
}
