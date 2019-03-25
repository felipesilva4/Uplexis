<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    
        public function run()
    {
        $user = new \App\User();
        $user -> create ([
            'email'=>'admin@admin.com',
            'name' => 'admin',
            'password'=> bcrypt('admin'), //bcrypt encripta a senha no BD
        ]);
    }
    
}
