<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KataKunciSeeder extends Seeder {

	
	public function run(){
		DB::table('katakunci')->delete();

        $kata = array(
            array('id' => 1, 'kata' => 'sudah','user_id' => 0),
            array('id' => 2, 'kata' => 'selesai','user_id' => 0),
        );
        foreach ($kata as $key) {
            DB::table('katakunci')->insert($key);
        }

        
	}

}
