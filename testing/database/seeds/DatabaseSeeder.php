<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $faker = Faker::create();
    	foreach (range(1,50000) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'job_title' => $faker->jobTitle,
	            'address' => $faker->address,
	            'bank_acc_no' => $faker->bankAccountNumber,
	            'cell_no' => $faker->e164PhoneNumber,
	        ]);
		}
    }
}
