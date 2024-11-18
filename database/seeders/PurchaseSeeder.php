<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i= 0; $i < 10; $i++) {
            $randomDate = Carbon::create(2022, random_int(1, 12), random_int(1, 28))->toDateString();
            DB::table('purchases')->insert([
                'purchase_date' => $randomDate,
                'total_price' => random_int(50, 300),
                'customer_id' => random_int(1, 5),
            ]); 
        }
    }
}
