<?php

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();

        User::create(array(
            'id' => 1,
            'name' => 'Default A',
            'email' => 'userA@beachmaster.gr',
            'password' => '1234',
            'image' => '/images/user.png'
        ));

        User::create(array(
            'id' => 2,
            'name' => 'Default B',
            'email' => 'userB@beachmaster.gr',
            'password' => '1234',
            'image' => '/images/user.png'
        ));

        User::create(array(
            'id' => 3,
            'name' => 'Default C',
            'email' => 'userC@beachmaster.gr',
            'password' => '1234',
            'image' => '/images/user.png'
        ));
    }

}
