<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder {

	public function run(){
		
		DB::table('users')->delete();
        date_default_timezone_set('Asia/Jakarta');
        //DB::statement("TRUNCATE TABLE role_user");
        //DB::statement("TRUNCATE TABLE Users");
        $users = array(
            array(
                'name'     => 'Administrator',
                'username' => 'admin',
                'nik' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('xcWI3128'),
                'isactive' => 1,
				'photo' => 'images/users/otamegane.gif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'     => 'Kuso Megane',
                'username' => 'kusomegane',
                'nik' => 'admin',
                'email'    => 'kusomegane@gmail.com',
                'password' => Hash::make('kusomegane'),
                'isactive' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'     => 'Si Mulut Busuk',
                'username' => 'mulutbusuk',
                'nik' => 'admin',
                'email'    => 'mulutbusuk@oranganeh.com',
                'password' => Hash::make('mulutbusuk'),
                'isactive' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'     => 'Pembela Kebenaran Kekasih Kemenangan',
                'username' => 'pembela',
                'nik' => 'admin',
                'email'    => 'pembela@oranganeh.com',
                'password' => Hash::make('pembela'),
                'isactive' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'     => 'Anak Hilang',
                'username' => 'anakhilang',
                'nik' => 'admin',
                'email'    => 'anakhilang@oranganeh.com',
                'password' => Hash::make('anakhilang'),    
                'isactive' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'     => 'Kung King Kang',
                'username' => 'kungkingkang',
                'nik' => 'admin',
                'email'    => 'kungkingkang@oranganeh.com',
                'password' => Hash::make('kungkingkang'),    
                'isactive' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            )
        );

        foreach ($users as $key) {
           DB::table('users')->insert($key);
            //\App\User::create($key);
        }
		
	}

}
