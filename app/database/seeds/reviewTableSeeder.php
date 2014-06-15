<?php

class reviewTableSeeder extends Seeder {
    //put your code here
    public function run(){
        DB::table('reviews')->delete();

        DB::table('reviews')->insert(
        array(
            'beachId' => 1,
            'title'  => 'Review #1',
            'text'   => 'Lorem Ipsum',
            'rate' => '4',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 2,
            'title'  => 'Review #2',
            'text'   => 'Lorem Ipsum2',
            'rate' => '3',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 3,
            'title'  => 'Review #3',
            'text'   => 'Lorem Ipsum3',
            'rate' => '2',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 3,
            'title'  => 'Review #3',
            'text'   => 'Lorem Ipsum3',
            'rate' => '4',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 4,
            'title'  => 'Review #4',
            'text'   => 'Lorem Ipsum4',
            'rate' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 5,
            'title'  => 'Review #5',
            'text'   => 'Lorem Ipsum5',
            'rate' => '2',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 6,
            'title'  => 'Review #6',
            'rate' => '3',
            'text'   => 'Lorem Ipsum6',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 7,
            'title'  => 'Review #7',
            'text'   => 'Lorem Ipsum7',
            'rate' => '4',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('reviews')->insert(
        array(
            'beachId' => 8,
            'title'  => 'Review #8',
            'text'   => 'Lorem Ipsum8',
            'rate' => '3',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
    }
}

?>
