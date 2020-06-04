<?php

use Illuminate\Database\Seeder;

class DrugTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $faker = Faker\Factory::create('fr_FR');
          $shops = App\Shop::where('id','<',50)->get('id');
          for ($i=0; $i < 400; $i++) { 
            $shop = $shops[rand(0,count($shops)-1)];
            App\Drug::create([
                'name' => $faker->company,
                'description' => $faker->realText(20),
                'labo' => $faker->company,
                'shop_id' => $shop->id
            ]);
          }
    }
}
