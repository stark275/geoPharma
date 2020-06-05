<?php

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        $mapCenterLatitude = -4.340249213281;
        $mapCenterLongitude = 15.315284729003;
        $minLatitude = $mapCenterLatitude - 0.05;
        $maxLatitude = $mapCenterLatitude + 0.05;
        $minLongitude = $mapCenterLongitude - 0.07;
        $maxLongitude = $mapCenterLongitude + 0.07;

        $users = App\User::where('type','pharmacian')->get('id');
            
        for ($i=0; $i < 50; $i++) { 
            $user = $users[rand(0,count($users)-1)];
            App\Shop::create([
                'name' => $faker->company,
                'cover' => $faker->catchPhrase,
                'longitude' =>$faker->longitude($minLongitude, $maxLongitude),
                'latitude' => $faker->latitude($minLatitude, $maxLatitude),
                'address' => $faker->address,
                'description' => $faker->realText(20), 
                'user_id' => $user->id
            ]);
        }
    }
}
