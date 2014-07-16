<?php

class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
 
        User::create(array(
            'username' => 'konos',
            'email'=>'konos@konos.com',
            'password' => Hash::make('1234')
        ));
 
    }
 
}