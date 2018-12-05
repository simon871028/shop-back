<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker  =  Faker\Factory::create('zh_TW');
        $status =['pay','stock','finish'];
        foreach (Range(1,100) as $number) {
                \App\Order::create([
                    'user_id' => rand(1,10),
                    'coupon_id' => null,
                    'amount' => rand(10000,300000),
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'company_name' => $faker->company,
                    'address' => $faker->address,
                    'email' => $faker->email,
                    'phone' => $faker->phoneNumber,
                    'status' => $status[rand(0,2)],
                    'created_at' => Carbon::now()->subMonth(2)->addHours(rand(1,5) + $number*5),
                    'updated_at' => Carbon::now()->subMonth(2)->addHours(rand(1,5) + $number*10)
                ]);
        }
    }
}
