<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
                $this->call('beachTableSeeder');
                $this->call('reviewTableSeeder');
                $this->call('prefectureTableSeeder');
                $this->call('municipalityTableSeeder');
	}

}
