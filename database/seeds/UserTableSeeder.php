<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'name'=> 'Carolina Ventura',
            'email'=>'carol@ua.pt',
            'password'=>bcrypt('istoeumamerda'),

        ]);

        \App\User::create([
            'name'=> 'Gabriel Faria',
            'email'=>'gabs@ua.pt',
            'password'=>bcrypt('istoeumamerda'),

        ]);
    }
}
