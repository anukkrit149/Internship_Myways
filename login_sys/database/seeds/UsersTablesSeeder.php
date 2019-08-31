<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Anukkrit Shanker',
            'email'    => 'anukkrit.official@gmail.com',
            'password'   =>  Hash::make('1234'),
            'remember_token' =>  str_random(10),
        ]);
    }
}
