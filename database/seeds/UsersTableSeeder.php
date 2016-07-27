<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            $user = \App\User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => Hash::make('secret'),
            ]);

            Artisan::call('lists:generate', ['user_id' => $user->id]);
        }
    }
}
