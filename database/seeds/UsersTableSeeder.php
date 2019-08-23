<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::create([
            'name' => 'TEste',
            'email' => 'teste@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $user =  User::create([
            'name' => 'teste2',
            'email' => 'teste2@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
