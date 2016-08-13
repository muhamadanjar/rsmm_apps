<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleSeeder extends Seeder {

    public function run(){
        
        DB::table('roles')->delete();

        $users = array(
            array(
                'id' => 1,
                'name'     => 'admin',
                'simbol' => 'admin',
            ),
            array(
                'id' => 2,
                'name'     => 'biasa',
                'simbol' => 'operator',
            ),
            array(
                'id' => 3,
                'name'     => 'supervisi',
                'simbol' => 'supervisi',
            )
        );

        foreach ($users as $key) {
            DB::table('roles')->insert($key);
        }

        
        
    }

}