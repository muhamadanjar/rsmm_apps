<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
		$seeders = array ('UserSeeder','RoleSeeder','RoleUserSeeder','KataKunciSeeder');

        foreach ($seeders as $seeder){ 
           $this->call($seeder);
        }
	}

}
