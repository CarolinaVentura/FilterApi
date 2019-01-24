<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::create([
            'name'=>'Malteasers',
            'barcode'=>'5000159020312'

        ]);

        \App\Product::create([
            'name'=>'Kit Kat',
            'barcode'=>'5000159020313'

        ]);
    }
}
