<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run t4he database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //user che noi usiamo per vedere come funziona e altro 
        $user = new User;
        $user->name = 'team7';
        $user->email = 'team7@team7.it';
        $user->password = bcrypt('team7');
        $user->is_admin = false;
        $user->save();
        //utenti creati con faker.
        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user->name = $faker->name();
            $user->email = $faker->email();
            $user->password = bcrypt('team7');
            $user->is_admin = false;
            $user->save();
        }
    }
}
