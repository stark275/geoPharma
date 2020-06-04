<?php

use Illuminate\Database\Seeder;

class DrugShopTableSeeder extends Seeder
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
        $drugs = App\Drug::where('id','<','400')->GET('id');

        foreach ($shops as $shop) {
            $nbr = rand(100,200);
            $data = [];
            for ($i=0; $i < $nbr ; $i++) {      
                $price = rand(1000,60000);
                $data[] = [
                   'drug_id' => $drugs[$i]->id,
                   'shop_id' => $shop->id,
                   'price' => $price
               ];
            }
            DB::table('drug_shop')->insertOrIgnore($data);
        }                  
    }
}
