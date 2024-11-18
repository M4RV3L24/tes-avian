<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=0; $i<6; $i++) {
            // \App\Models\Customer::factory()->create();

            $faker = Faker::create();
            
            DB::table('customers')->insert([
                'customer_name' => $faker->name(),
                'customer_email' => $faker->email(),
                'customer_phone' => $faker->phoneNumber(),
                'customer_address' => $faker->address(),
            ]);
        }
    }
}
