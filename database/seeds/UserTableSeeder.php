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
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 10; $i++) { 
             App\User::create([
                'name' => $faker->name,
                'email' => $faker->safeEmail ,
                'type' => ($faker->boolean === true) ? 'client' : 'pharmacian',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            ]);
        }
       
    }
}
