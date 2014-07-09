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

		$this->call('userTableSeeder');
                $this->call('prefectureTableSeeder');
                $this->call('municipalityTableSeeder');
                $this->call('beachTableSeeder');
                $this->call('reviewTableSeeder');
                $this->call('utilitiesTableSeeder');
                $this->call('imagesTableSeeder');
                
	}

}
