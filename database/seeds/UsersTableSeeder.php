<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'username' => 'admin001',
            'email' =>  'admin@email.com',
            'password' => bcrypt('password1'),
            'role' => 'admin'
        ]);
        $user->save();
    }
}
